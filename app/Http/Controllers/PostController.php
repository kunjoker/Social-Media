<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use MongoDB\Client;

class PostController extends Controller
{
    public function connext()
    {
        $client = new Client('mongodb://localhost:27017');
        $database = $client->selectDatabase('local');
        $collection = $database->selectCollection('Data');
        $document = $collection->findOne([]);

        return [
            'document' => $document,
            'collection' => $collection
        ];
    }

    public function index()
    {

        $Data = Posts::all();
        $user = User::all();

        $post = $Data[0]['posts'];
        $users =  $user[0]['users'];

        return view('users.posts', ['posts' => $post, 'users' => $users]);
    }
    public function show($userId)
    {

        $data = User::all();
        $users = $data[0]['users'];
        $posts = $data[0]['posts'];

        $targetUser = null;

        foreach ($users as $user) {
            if ($user['userId'] == $userId) {
                $targetUser = $user;
                break;
            }
        }

        $filteredPosts = collect($posts)->where('userId', $userId);

        if ($targetUser && $filteredPosts->isNotEmpty()) {
            return view('users.posts', ['posts' => $filteredPosts, 'user' => $targetUser]);
        } else {
            return view('users.posts', ['posts' => [], 'user' => $targetUser]);
        }
    }


    public function profile($userId)
    {
        $Data = Posts::all();
        $users = $Data[0]['users'];
        $targetUser = null;


        foreach ($users as $user) {
            if ($user['userId'] == $userId) {
                $targetUser = $user;
                break;
            }
        }



        if ($targetUser) {
            return view('users.show', ['user' => $targetUser]);
        } else {

            abort(404);
        }
    }
    public function create()
    {
        return view('users.posts');
    }

    public function store(Request $request, $userId)
    {
        $result = $this->connext();
        $document = $result['document'];
        $collection = $result['collection'];

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $posts = $document['posts'];
        $users = $document['users'];

        $userIndex = null;
        foreach ($users as $index) {
            if ($index['userId'] == $userId) {
                $userIndex = $index;
                break;
            }
        }

        $highestUserId = 0;
        foreach ($posts as $post) {
            if ($post['postId'] > $highestUserId) {
                $highestUserId = $post['postId'];
            }
        }

        $newPostId = $highestUserId + 1;
        $newPost = [
            'postId' => $newPostId,
            'userId' => $userId,
            'content' => $request->input('content'),
            'likes' => [],
            'comments' => [],
            'createdAt' => date('Y-m-d')
        ];

        $posts[] = $newPost;

        $userIndex['posts'][] = $newPostId;
        $updateResult = $collection->updateOne([], ['$set' => ['posts' => $posts, 'users' => $users]]);

        if ($updateResult->getModifiedCount() > 0) {
            return $this->show($userId);
        } else {
            return response()->json(['error' => 'Failed to add post'], 500);
        }
    }

    public function destroy($userId,$postId)
    {
        $result = $this->connext();
        $document = $result['document'];
        $collection = $result['collection'];

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $posts = $document['posts'];
        $users = $document['users'];
        // Find the index of the post in the $posts array
        $postIndex = null;
        foreach ($posts as $index => $post) {

            if ($post['postId'] == $postId) {
                $postIndex = $index;
                break;
            }
        }

        if ($postIndex !== null) {
            // Remove the post from the $posts array
            $deletedPost = $posts[$postIndex];
            unset($posts[$postIndex]);

            // Convert BSONArray to PHP array
            $comments = iterator_to_array($document['comments']);

            // Remove the comments associated with the post from the $comments array
            $comments = array_filter($comments, function ($comment) use ($postId) {
                return $comment['postId'] != $postId;
            });

            foreach ($users as &$user) {
                if ($user['userId'] == $userId) {
                    foreach ($user['posts'] as $key => $postIdValue) {
                        if ($postIdValue == $postId) {
                            unset($user['posts'][$key]);
                            break;
                        }
                    }
                }
            }
            unset($user);

            $updateResult = $collection->updateOne([], [
                '$set' => [
                    'posts' => $posts,
                    'users' => $users,
                    'comments' => $comments
                ]
            ]);

            if ($updateResult->getModifiedCount() > 0) {
                return $this->show($userId);
            } else {
                return response()->json(['error' => 'Failed to delete post or comments'], 500);
            }
        } else {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }
}

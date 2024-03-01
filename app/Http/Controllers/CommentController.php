<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use MongoDB\Client;

class CommentController extends Controller
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
    public function show($userId, $postId)
    {
        $data = User::all();
        $users = $data[0]['users'];
        $posts = $data[0]['posts'];
        $document = $this->connext()['document'];

        $targetUser = null;
        $targetPost = null;
        $comments = [];

        foreach ($users as $user) {
            if ($user['userId'] == $userId) {
                $targetUser = $user;
                break;
            }
        }

        foreach ($posts as $post) {
            if ($post['postId'] == $postId) {
                $targetPost = $post;
                break;
            }
        }

        if ($document && $targetUser && $targetPost) {
            $comments = collect($document['comments'])->where('postId', $postId);
        }

        return view('users.comment', ['posts' => $posts, 'user' => $targetUser, 'comments' => $comments, 'targetPost' => $targetPost]);
    }

    public function create($userId, $postId)
    {
        return view('users.comment', ['userId' => $userId, 'postId' => $postId]);
    }

    public function store(Request $request, $userId, $postId)
    {
        $result = $this->connext();
        $document = $result['document'];
        $collection = $result['collection'];

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $posts = $document['posts'];

        $comment = $document['comments'];

        $postIndex = null;

        foreach ($posts as  $post) {
            if ($post['postId'] == $postId) {
                echo $post['postId'];
                $postIndex = $post;

                break;
            }
        }

        if ($postIndex === null) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $highestUserId = 0;
        foreach ($comment as $comments) {
            if ($comments['commentId'] > $highestUserId) {
                $highestUserId = $comments['commentId'];
            }
        }

        $newCommentId = $highestUserId + 1;
        $newComment = [
            'commentId' => $newCommentId,
            'postId' => $postId,
            'userId' => $userId,
            'content' => $request->input('content'),
            'createdAt' => date('Y-m-d')
        ];

        $comment[] = $newComment;
        $postIndex['comments'][] = $newCommentId;


        $updateResult = $collection->updateOne([], ['$set' => [
            'posts' => $posts, 'comments' => $document['comments']
        ]]);

        if ($updateResult->getModifiedCount() > 0) {
            return response()->json(['message' => 'Comment added successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to add comment'], 500);
        }
    }

    public function delete($userId, $postId, $commentId)
    {
        $result = $this->connext();
        $document = $result['document'];
        $collection = $result['collection'];

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $posts = $document['posts'];
        $comments = $document['comments'];

        $postIndex = null;
        foreach ($posts as $index => $post) {
            if ($post['postId'] == $postId) {
                $postIndex = $index;
                break;
            }
        }

        if ($postIndex === null) {
            return response()->json(['error' => 'Post not found'], 404);
        }


        $comments = collect($comments)->reject(function ($comment) use ($commentId) {
            return $comment['commentId'] == $commentId;
        })->values()->all();


        $posts[$postIndex]['comments'] = $comments;


        $updateResult = $collection->updateOne([], ['$set' => [
            'posts' => $posts,
            'comments' => $comments
        ]]);

        if ($updateResult->getModifiedCount() > 0) {
            return $this->show($userId, $postId);
        } else {
            return response()->json(['error' => 'Failed to delete comment'], 500);
        }
    }
}

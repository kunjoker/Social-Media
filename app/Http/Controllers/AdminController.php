<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;
use MongoDB\Client;
use App\Models\Counter;

class AdminController extends Controller
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

        $Data = User::all();
        $posts = User::all();

        $post = $posts[0]['posts'];
        $user = $Data[0]['users'];

        return view('admin.users', ['posts' => $post, 'users' => $user]);
    }
    public function home()
    {

        $Data = User::all();

        $admin = $Data[0]['admin'];

        return view('admin.index', ['admin' => $admin]);
    }
    public function create()
    {
        return view('users.register');
    }
    public function store(Request $request)
    {
        $result = $this->connext();
        $document = $result['document'];
        $collection = $result['collection'];

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $users = $document['users'];

        $highestUserId = 0;
        foreach ($users as $user) {
            if ($user['userId'] > $highestUserId) {
                $highestUserId = $user['userId'];
            }
        }

        $newUserId = $highestUserId + 1;

        /**
         * Generate a unique user ID.
         *
         * @return string
         */

        $newUser = [
            'userId' => $newUserId,
            'username' => $request->input('username'),
            'fullName' => $request->input('fullName'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'birthdate' => $request->input('birthdate'),
            'location' => $request->input('location'),
            'bio' => $request->input('bio'),
            'friends' => [],
            'posts' => [],
            'createdAt' => date('Y-m-d')
        ];

        $users[] = $newUser;

        $updateResult = $collection->updateOne([], ['$set' => ['users' => $users]]);

        if ($updateResult->getModifiedCount() > 0) {
            return $this->index();
        } else {
            return response()->json(['error' => 'Failed to add user'], 500);
        }
    }
    public function storeAdmins(Request $request)
    {
        $result = $this->connext();
        $document = $result['document'];
        $collection = $result['collection'];

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $admin = $document['admin'];


        /**
         * Generate a unique user ID.
         *
         * @return string
         */

        $newadmin = [
            'adminId' => uniqid(),
            'username' => $request->input('username'),
            'fullName' => $request->input('fullName'),
            'password' => $request->input('password'),
            'createdAt' => date('Y-m-d')
        ];

        $admin[] = $newadmin;

        $updateResult = $collection->updateOne([], ['$set' => ['admin' => $admin]]);

        if ($updateResult->getModifiedCount() > 0) {
            return $this->index();
        } else {
            return response()->json(['error' => 'Failed to add user'], 500);
        }
    }
    public function show($userId)
    {
        $data = User::all();
        $users = $data[0]['users'];


        $targetUser = null;
        foreach ($users as $user) {
            if ($user['userId'] == $userId) {
                $targetUser = $user;
                break;
            }
        }


        if ($targetUser) {
            return view('admin.show', ['user' => $targetUser]);
        } else {

            abort(404);
        }
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function deleteUser($userId)
    {
        $Data = User::all();

        $users = $Data[0]['users'];
        $posts = $Data[0]['posts'];
        $comments = $Data[0]['comments'];

        $targetUser = null;
        foreach ($users as $user) {
            if ($user['userId'] == $userId) {
                $targetUser = $user;
                break;
            }
        }

        if ($targetUser) {
            $userIndex = array_search($targetUser, $users);
            unset($users[$userIndex]);

            foreach ($posts as $post) {
                if ($post['userId'] == $userId) {
                    $postIndex = array_search($post, $posts);
                    unset($posts[$postIndex]);
                }
            }

            foreach ($comments as $comment) {
                if ($comment['userId'] == $userId) {
                    $commentIndex = array_search($comment, $comments);
                    unset($comments[$commentIndex]);
                }
            }

            $result = $this->connext();
            $document = $result['document'];
            $collection = $result['collection'];

            $updateResult = $collection->updateOne([], ['$set' => ['users' => array_values($users), 'posts' => array_values($posts), 'comments' => array_values($comments)]]);

            if ($updateResult->getModifiedCount() > 0) {
                return $this->index();
            } else {
                return response()->json(['error' => 'Failed to delete user'], 500);
            }
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }



    }
    public function log()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        $result = $this->connext();
        $document = $result['document'];
        $collection = $result['collection'];
        $users = $document['users'];
        $admins = $document['admin'];

        $fullName = $request->input('fullName');
        $password = $request->input('password');
        $check =    $request->input('check');

        $targetUser = null;
        $targetAdmin = null;
        if ($check == 'admin') {
            foreach ($admins as $admin) {
                if (($admin['fullName'] == $fullName) && ($admin['password'] == $password)) {
                    $targetAdmin = $admin;
                }
            }
        } else {
            foreach ($users as $user) {
                if (($user['fullName'] == $fullName) && ($user['password'] == $password)) {
                    $targetUser = $user;
                }
            }
        }

        if ($targetUser) {
            return view('users.show', ['user' => $targetUser]);
        } else if ($targetAdmin) {
            $data = User::all();
            $users = $data[0]['users'];

            return view('admin.users', ['users' => $users]);
        } else {
            return response()->json(['error' => ' not fund'], 404);
        }
    }
}

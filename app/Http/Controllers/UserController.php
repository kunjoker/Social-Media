<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use MongoDB\Client;

use function Ramsey\Uuid\v1;

class UserController extends Controller
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

        $users = User::all();

        $user = $users[0]['users'];

        return view('users.users', ['users' => $user]);
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
            return view('users.show', ['user' => $targetUser]);
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


}

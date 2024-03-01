<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

    <div class="container">
        <h1 class="mt-4">User Details</h1>
        <div class="card-body">
            <form id="createPostForm1" action="{{ route('user.delete',$user['userId']) }}" method="POST">
                @csrf
            <h5 class="card-title">{{ $user['fullName'] }}</h5>
            <p class="card-text"><strong>User ID:</strong> {{ $user['userId'] }}</p>
            <p class="card-text"><strong>Username:</strong> {{ $user['username'] }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $user['email'] }}</p>
            <p class="card-text"><strong>Birthdate:</strong> {{ $user['birthdate'] }}</p>
            <p class="card-text"><strong>Location:</strong> {{ $user['location'] }}</p>
            <p class="card-text"><strong>Bio:</strong> {{ $user['bio'] }}</p>
            <p class="card-text"><strong>Friends:</strong> {{ implode(', ', (array) ($user['friends'] ?? [])) }}</p>
            <p class="card-text"><strong>Posts:</strong> {{ implode(', ', (array) ($user['posts'] ?? [])) }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $user['createdAt'] }}</p>
            <button type="submit" class="btn btn-outline-danger">Delete</button>
            <a href="{{ route('admin.users') }}" class="btn btn-primary">Back</a>
        </div>
    </div>



@endsection

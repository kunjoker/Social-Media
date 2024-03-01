@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="container">
        <div class="d-grid gap-1 col-10 mx-auto">
            <h1 class="mt-4">My Profile</h1>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="card-body ">
                    <p class="card text-center"><strong>Username:</strong> {{ $user['username'] }}</p>
                    <p class="card text-center"><strong>fullName:</strong>{{ $user['fullName'] }}</p>
                    <p class="card text-center"><strong>Email:</strong> {{ $user['email'] }}</p>
                    <p class="card text-center"><strong>Birthdate:</strong> {{ $user['birthdate'] }}</p>
                    <p class="card text-center"><strong>Location:</strong> {{ $user['location'] }}</p>
                    <div>
                        <p>
                        <div class="d-grid gap-2 col-3 mx-auto">
                            <button class="btn btn-outline-success" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseWidthExample" aria-expanded="false"
                                aria-controls="collapseWidthExample">
                                Bio
                            </button>
                        </div>
                        </p>
                        <div style="min-height: mx-auto;">
                            <div class="collapse collapse-horizontal" id="collapseWidthExample">
                                <div class="card card-body" style="width: 500px; min-height: 120px;">
                                    <p class="card-text">{{ $user['bio'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-grid gap-2 col-3 mx-auto">
                <a class="btn btn-outline-secondary" href="{{ route('users.posts', $user['userId']) }}">Show My Posts</a>
            </div>
        </div>
    </div>

@endsection

<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($admin)
                    <h2 class="mb-4">Login</h2>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="fullName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="check" id="userCheck"
                                            value="user" checked>
                                        <label class="form-check-label" for="userCheck">
                                            User
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="check" id="adminCheck"
                                            value="admin">
                                        <label class="form-check-label" for="adminCheck">
                                            Admin
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>

                        </div>
                    </div>
                @else
                    <div class="container">
                        <h1>Admin Registration</h1>
                        <div class="card">
                            <div class="card-body">
                                <form id="createPostForm" action="{{ route('admin.store') }}" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="username" placeholder="username"
                                            name="username" required>
                                        <label for="username">Username:</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="fullName" placeholder="fullName"
                                            name="fullName" required>
                                        <label for="fullName">Full Name:</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                            name="password" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="d-grid gap-1 col-3 mx-auto">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Add User</button>
                                        <a class="btn btn-outline-primary" href="{{ route('admin.users') }}">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

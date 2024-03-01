<!-- resources/views/users/register.blade.php -->

@extends('layouts.app')

@section('title', 'User Registration')

@section('content')
    <div class="container">
        <h1>User Registration</h1>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card card-body" style="width: 500px; min-height: 50px;">
                            <button class="btn btn-outline-success" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseWidthExample" aria-expanded="false"
                                aria-controls="collapseWidthExample">
                               Add User
                            </button>

                            <div class="collapse collapse-horizontal col mt-4 " id="collapseWidthExample">
                                <form id="createPostForm" action="{{ route('user.store') }}" method="POST">
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
                                        <input type="email" class="form-control" id="email"
                                            placeholder="name@example.com" name="email" required>
                                        <label for="email">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                            name="password" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                                        <label for="birthdate">Birthdate:</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="location" placeholder="location"
                                            name="location" required>
                                        <label for="location">Location:</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="bio" name="bio" placeholder="bio" rows="3"></textarea>
                                        <label for="bio">Bio:</label>
                                    </div>
                                    <div class="d-grid gap-1 col-3 mx-auto">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Add
                                            </button>
                                        <a class="btn btn-outline-primary" href="{{ route('admin.users') }}">Back</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-body" style="width: 500px; min-height: 50px;">
                            <button class="btn btn-outline-success" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseWidthExample1" aria-expanded="false"
                                aria-controls="collapseWidthExample">
                                Add user as Admin
                            </button>
                            <div class="collapse collapse-horizontal col mt-4" id="collapseWidthExample1">
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
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Password" name="password" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="d-grid gap-1 col-3 mx-auto">
                                        <button type="submit" class="btn btn-outline-primary ">
                                            Add
                                            </button>
                                        <a class="btn btn-outline-primary" href="{{ route('admin.users') }}">Back</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('createPostForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var form = event.target;
                var formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.href =
                                '{{ route('admin.users') }}';
                        } else {
                            throw new Error('Failed to create post');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection

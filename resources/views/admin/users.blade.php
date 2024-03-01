@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="container">

        <h1 class="mt-4">User List</h1>
        <div class="card mt-4">
            <div class="card-body" style="overflow-x: auto;">
                <table class="table table-bordered mx-auto" style="width: 90%;">
                    <thead class="table-dark">
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Birthdate</th>
                            <th>Location</th>
                            <th>Posts</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        @foreach ($users as $user)
                            <tr id="user-row-{{ $user['userId'] }}">
                                <td>{{ $user['userId'] }}</td>
                                <td>{{ $user['username'] }}</td>
                                <td>{{ $user['fullName'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['birthdate'] }}</td>
                                <td>{{ $user['location'] }}</td>
                                <td>{{ implode(', ', $user['posts']) }}</td>
                                <td>{{ $user['createdAt'] }}</td>
                                <td>
                                    <button class="btn btn-outline-danger" onclick="deleteUser({{ $user['userId'] }})">Delete</button>
                                </td>
                            </tr>
                            </form>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-grid gap-1 col-3 mx-auto">
                    <a href="{{ route('user.create') }}" class="btn btn-success btn-lg btn-block">Add user</a>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                fetch('{{ route('user.delete', ':userId') }}'.replace(':userId', userId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        document.getElementById('user-row-' + userId).remove();
                        alert('User deleted successfully');
                    } else {
                        throw new Error('Failed to delete user');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete user');
                });
            }
        }
    </script>
@endsection

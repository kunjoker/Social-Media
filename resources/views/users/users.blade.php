<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <h1 class="mt-4">User List</h1>
        <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Birthdate</th>
                    <th>Location</th>
                    <th>Bio</th>
                    <th>Friends</th>
                    <th>Posts</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['userId'] }}</td>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $user['fullName'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['birthdate'] }}</td>
                        <td>{{ $user['location'] }}</td>
                        <td>{{ $user['bio'] }}</td>
                        <td>{{ implode(', ', $user['friends']) }}</td>
                        <td>{{ implode(', ', $user['posts']) }}</td>
                        <td>{{ $user['createdAt'] }}</td>
                        <td>
                            <a href="{{ route('users.show', $user['userId']) }}" class="btn btn-primary">Show</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-grid gap-2 col-3 mx-auto">
        <a class="btn btn-outline-primary  " href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

</body>

</html>

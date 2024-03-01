@extends('users.show')

@section('content')
    <div class="container ">
        <h1 class="mt-4">Posts List</h1>
        <div class="container ">
            <h1 class="mt-4">Create Post</h1>
            <form id="createPostForm" action="{{ route('posts.store', $user['userId']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary">Add Post</button>
            </form>
        </div>
        <div class="d-grid gap-2 col-3 mx-auto">
            <a class="btn btn-outline-primary" href="{{ route('users.show', $user['userId']) }}">Hide list</a>
        </div>
        <h5 class="mt-4">User Posts</h5>
        <div class="card-body ">
            @if (!empty($posts))
                <div class="list-group " style="max-height: 400px; overflow-y: auto;">
                    @foreach ($posts as $post)
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="max-height: 25px;">
                                    <h5 class="card-title">{{ $post['content'] }}</h5>
                                    <div class="total-comments">
                                        <a href="{{ route('users.comment', ['userId' => $post['userId'], 'postId' => $post['postId']]) }}"
                                            class="list-group-item list-group-item-action ">
                                            <p class="text-muted">Total Comments: <span
                                                    class="badge bg-primary ">{{ count($post['comments']) }}</span></p>
                                        </a>
                                    </div>
                                    <form id="deletePostForm-{{ $post['postId'] }}"
                                        action="{{ route('posts.delete', ['userId' => $user['userId'], 'postId' => $post['postId']]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-grid gap-2 ">
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                                <p class="card-text">{{ $post['createdAt'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No posts found for this user.</p>
            @endif
        </div>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#createPostForm').forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
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
                                window.location.reload();
                            } else {
                                throw new Error('Failed to create post');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('createPostForm1').addEventListener('submit', function(event) {
                event.preventDefault();
                var form = event.target;
                var formData = new FormData(form);

                fetch(form.action, {
                        method: 'DELETE',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload();
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

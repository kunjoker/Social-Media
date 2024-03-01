@extends('users.posts')

@section('content')
    <div class="container">
        <h1 class="mt-4">Posts </h1>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="card-body">
                <h5>{{ $targetPost['content'] }}</h5>
                <p>{{ $targetPost['createdAt'] }}</p>

                <form id="createPostForm"
                    action="{{ route('comment.store', ['userId' => $user['userId'], 'postId' => $targetPost['postId']]) }}"
                    method="POST">
                    @csrf
                    <textarea class="form-control mt-4" id="content" name="content" rows="3" required></textarea>
                    <div class="d-grid gap-2 d-md-block mt-4">
                        <button type="submit" class="btn btn-outline-primary ms-2">Add comment</button>
                        <a class="btn btn-outline-primary" href="{{ route('users.posts', $user['userId']) }}">Back to My
                            Posts</a>

                    </div>
                </form>
                <div class="mt-5">
                    @php
                        $postComments = $comments->where('postId', $targetPost['postId']);
                    @endphp
                    @if ($postComments->isNotEmpty())
                        <h6>Comments:</h6>
                        <ul class="list-group" style="max-height: 500px; overflow-y: auto;">
                            @foreach ($postComments as $comment)
                                <div class="card  mb-3 mt-4">
                                    <li class="list-group-item ">
                                        <div class="d-flex justify-content-between">
                                        {{ $comment['content'] }}
                                    <form
                                        action="{{ route('comment.delete', ['userId' => $user['userId'], 'postId' => $targetPost['postId'], 'commentId' => $comment['commentId']]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
                                    </form>
                                </div>
                                </li>
                                </div>
                            @endforeach
                        </ul>
                    @else
                        <p>No comments</p>
                    @endif

                </div>
            </div>
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
    </script>
@endsection

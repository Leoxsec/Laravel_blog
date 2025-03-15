@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ Auth::user()->isAdmin() ? 'Manage All Posts' : 'Manage Your Posts' }}</h2>

            <div class="d-flex">
                <!-- Form Search -->
                <form method="GET" action="" class="d-flex me-2">
                    <input type="text" name="user_id" class="form-control me-2" placeholder="User ID" value="{{ request('user_id') }}">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search posts..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <!-- Filter Dropdown -->
                <div class="dropdown me-2">
                    <button class="btn btn-success dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="?filter=7">1 Minggu Terakhir</a></li>
                        <li><a class="dropdown-item" href="?filter=14">2 Minggu Terakhir</a></li>
                        <li><a class="dropdown-item" href="?filter=21">3 Minggu Terakhir</a></li>
                        <li><a class="dropdown-item" href="?filter=28">4 Minggu Terakhir</a></li>
                        <li><a class="dropdown-item" href="?filter=all">Semua</a></li>
                    </ul>
                </div>

                <!-- Delete All Button -->
                <form method="POST" action="" id="deleteAllForm">
                    @csrf
                    <button type="button" class="btn btn-danger" onclick="confirmDeleteAll()">Delete All</button>
                </form>
            </div>
        </div>

        <!-- Fetch Data Langsung di Blade -->
        @php
            $query = \App\Models\Post::query();

            if (request('user_id')) {
                $query->where('user_id', request('user_id'));
            }

            if (request('search')) {
                $query->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('description', 'like', '%' . request('search') . '%');
            }

            if (request('filter') && request('filter') != 'all') {
                $query->where('created_at', '>=', now()->subDays(request('filter')));
            }

            $posts = $query->orderBy('created_at', 'desc')->paginate(3);
        @endphp

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th style="width: 300px;">Description</th>
                        <th>Image</th>
                        @if (Auth::user()->isAdmin())
                            <th>Posted by</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->description, 100, '...') }}</td>
                            <td>
                                @if ($post->thumbnail)
                                    <img class="img-fluid rounded" loading="lazy"
                                         src="{{ asset('images/thumbnails/' . $post->thumbnail) }}" 
                                         alt="{{ $post->title }}"
                                         style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            @if (Auth::user()->isAdmin())
                                <td><small>{{ $post->user->name }}</small></td>
                            @endif
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="showDeleteModal({{ $post->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? 6 : 5 }}" class="text-center">No posts found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(postId) {
            document.getElementById('delete-form').action = `/posts/${postId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        function confirmDeleteAll() {
            if (confirm("Are you sure you want to delete ALL posts? This action cannot be undone.")) {
                fetch('/delete-all-posts', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          alert("All posts deleted successfully!");
                          location.reload();
                      } else {
                          alert("Failed to delete posts.");
                      }
                  });
            }
        }
    </script>
@endsection

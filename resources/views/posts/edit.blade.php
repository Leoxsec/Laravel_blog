@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Edit Post') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="postTitle" class="form-label">Post Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="postTitle" placeholder="Enter Post Title"
                                    value="{{ old('title', $post->title) }}" required>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="postDescription" class="form-label">Post Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="postDescription"
                                    rows="5" placeholder="Enter Your Description" required>{{ old('description', $post->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="postThumbnail" class="form-label">Post Thumbnail</label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                    name="thumbnail" id="postThumbnail">
                                @if ($post->thumbnail)
                                    <div class="mt-3">
                                        <img alt="Current Thumbnail" class="img-thumbnail" style="max-width: 250px; height: auto;"
                                            src="{{ asset('images/thumbnails/' . $post->thumbnail) }}" alt="{{ $post->title }}">
                                    </div>
                                @endif
                                @error('thumbnail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Update Post</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container m-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">{{ __('New Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Post Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="postTitle" placeholder="Enter Post Title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="postDescription" class="form-label">Post Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="postDescription" rows="5" placeholder="Enter Your Description" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail (optional)</label>
                            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail">
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

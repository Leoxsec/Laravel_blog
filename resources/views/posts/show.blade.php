                                                         @extends('layouts.app')

                                                        @section('content')
                                                            <div class="container my-5">
                                                                <div class="row justify-content-center">
                                                                    <div class="col-md-8">
                                                                        <div class="card shadow-lg border-0 rounded">
                                                                            <div class="card-header bg-primary text-white text-center">
                                                                                <h2 class="mb-0">{{ $post->title }}</h2>
                                                                            </div>

                                                                            <div class="card-body">
                                                                                <!-- Gambar Artikel -->
                                                                                <div class="text-center mb-3">
                                                                                    <img class="img-fluid rounded shadow-sm" loading="lazy"
                                                                                        src="{{ asset('images/thumbnails/' . ($post->thumbnail ?? 'fallback.jfif')) }}"
                                                                                        alt="{{ $post->title }}" style="max-height: 400px; object-fit: cover;">
                                                                                </div>

                                                                                <!-- Artikel dalam kotak dengan teks tertata -->
                                                                                <div class="border p-3 rounded bg-light" style="white-space: pre-line;">
                                                                                    {!! nl2br(e($post->description)) !!}
                                                                                </div>
                                                                            </div>

                                                                            <div class="card-footer bg-light text-muted d-flex justify-content-between align-items-center">
                                                                                <small>Posted on: {{ $post->created_at->format('Y-m-d') }}</small>
                                                                                <small>Ditulis oleh: <strong>{{ $post->user->name ?? 'Anonim' }}</strong></small>
                                                                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                                                                                    <i class="fas fa-arrow-left"></i> Back
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endsection

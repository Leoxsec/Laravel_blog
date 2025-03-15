@extends('layouts.app')

@section('content')
    @if ($posts->count() > 0)
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <h2 class="display-5 mb-4 mb-md-5 text-center">All Posts</h2>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
        </div>
    @else
        <div class="alert alert-info ms-3 me-3 mt-4" role="alert">
            No posts available. Check back later!
        </div>
    @endif

    <section class="bsb-blog-5 py-2 py-md-5 py-xl-2">
        <div class="container overflow-hidden">
            <div class="row gy-4 gy-md-5 gx-xl-6 gy-xl-6 gx-xxl-9 gy-xxl-9">
                @foreach ($posts as $post)
                    <div class="col-12 col-lg-4">
                        <article>
                            <div class="card border-0 bg-transparent">
                                <figure class="card-img-top mb-4 overflow-hidden bsb-overlay-hover">
                                    <a href="{{ route('posts.show', $post->id) }}">
                                        <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy"
                                            src="{{ asset('images/thumbnails/' . $post->thumbnail) }}"
                                            alt="{{ $post->title }}">
                                    </a>
                                    <figcaption>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>
                                        <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Read More</h4>
                                    </figcaption>
                                </figure>
                                <div class="card-body m-0 p-0">
                                    <div class="entry-header mb-3">
                                        <h2 class="card-title entry-title h4 m-0">
                                            {{ $post->title }}
                                        </h2>
                                        <p class="link-dark text-decoration-none">
                                            {{ \Illuminate\Support\Str::limit($post->description, 150) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer border-0 bg-transparent p-0 m-0">
                                    <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                                        <li class="px-1 py-1">
                                            <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center"
                                                href="#!">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-person me-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a5 5 0 0 0-4.546 2.916.5.5 0 0 0 .898.416A4 4 0 0 1 8 10c1.48 0 2.776.805 3.648 2.086a.5.5 0 1 0 .894-.448A5 5 0 0 0 8 9z" />
                                                </svg>
                                                <span class="fs-7">{{ $post->user->name }}</span>
                                            </a>
                                        </li>
                                        <li class="px-1 py-1">
                                            <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center"
                                                href="#!">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-calendar3 me-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                                    <path
                                                        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                                </svg>
                                                <span class="ms-2 fs-7">{{ $post->created_at->format('Y-m-d') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    <!-- Pagination Links -->
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('content')
    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-3">
                                <a href="#!">
                                    <img src="{{ asset('images/blog.png') }}" alt="BlogNest Logo" class="custom-img"
                                        width="100">

                                </a>
                            </div>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Sign in to your account</h2>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" placeholder="name@example.com"
                                                value="{{ old('email') }}" required>
                                            <label for="email" class="form-label">Email</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="password" placeholder="Password" required>
                                            <label for="password" class="form-label">Password</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-primary btn-lg" type="submit">Log in</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">Don't have an account?
                                            <a href="{{ route('register') }}"class="link-primary text-decoration-none">Sign
                                                up</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

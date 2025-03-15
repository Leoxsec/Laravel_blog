<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h3 style="color: #028773;">InfoTech</h3> <!-- Ubah warna heading -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Menu -->
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                @auth
                    @if (Auth::user()->role !== 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.create') }}">New Post</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.manage') }}">Manage Posts</a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side Menu -->
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link btn btn-success text-white px-3 py-2 rounded-pill shadow-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Custom CSS -->
<style>
    /* Ubah warna hover menu */
    /* .navbar-nav .nav-item .nav-link:hover {
        color: #028773 !important;
    } */

    /* Warna teks navbar saat aktif */
    .navbar-nav .nav-item .nav-link.active {
        color: #028773 !important;
    }

    /* Efek transisi agar lebih halus */
    .navbar-nav .nav-item .nav-link {
        transition: color 0.3s ease-in-out;
    }

    /* Tombol login dengan hiasan tambahan */
    .btn-success {
        background-color: #028773 !important;
        border-color: #028773 !important;
        transition: all 0.3s ease-in-out;
    }

    /* .btn-success:hover {
        background-color: #026b5e !important;
        border-color: #026b5e !important;
        box-shadow: 0 0 10px rgba(2, 135, 115, 0.6);
    } */
</style>

@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Users List</h2>
            <div class="d-flex align-items-center">
                <!-- FORM PENCARIAN -->
                <form method="GET" action="" class="d-flex align-items-center me-2">
                    <div class="input-group w-auto">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari user..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-success btn-sm">Cari</button>
                    </div>
                </form>
                <button class="btn btn-danger btn-sm me-2" onclick="showDeleteAllModal()">Hapus Semua</button>
                <div class="dropdown">
                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="#" onclick="filterUsers(7)">1 Minggu Terakhir</a></li>
                        <li><a class="dropdown-item" href="#" onclick="filterUsers(14)">2 Minggu Terakhir</a></li>
                        <li><a class="dropdown-item" href="#" onclick="filterUsers(21)">3 Minggu Terakhir</a></li>
                        <li><a class="dropdown-item" href="#" onclick="filterUsers(28)">4 Minggu Terakhir</a></li>
                        <li><a class="dropdown-item" href="#" onclick="filterUsers(0)">Semua</a></li>
                    </ul>
                </div>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <!-- @php
            // Ambil data dari database dengan pencarian
            $users = \App\Models\User::where('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END, created_at DESC") // Admin di atas
                ->paginate(3);
        @endphp -->

        @php
    // Ambil data dari database dengan pencarian
    $users = \App\Models\User::where('id', request('search')) // Mencari berdasarkan ID
        ->orWhere('name', 'like', '%' . request('search') . '%')
        ->orWhere('email', 'like', '%' . request('search') . '%')
        ->orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END, created_at DESC") // Admin di atas
        ->paginate(3);
    @endphp


        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle" id="userTable">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>  
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Registered At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @forelse ($users as $user)
                        <tr class="table-light"> 
                            <td>{{ $user->id }}</td>
                            <td class="user-name">{{ $user->name }}</td>
                            <td class="user-email">{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm">View</button>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="showDeleteModal({{ $user->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

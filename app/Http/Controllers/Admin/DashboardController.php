<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil bulan dan tahun saat ini
        $currentMonth = Carbon::now()->format('F Y');

        // Hitung jumlah user yang mendaftar bulan ini
        $usersCount = User::whereMonth('created_at', Carbon::now()->month)
                          ->whereYear('created_at', Carbon::now()->year)
                          ->count();

        // Hitung jumlah post yang dibuat bulan ini
        $postsCount = Post::whereMonth('created_at', Carbon::now()->month)
                          ->whereYear('created_at', Carbon::now()->year)
                          ->count();

        // Ambil data jumlah user dan post per hari dalam bulan ini
        $dates = [];
        $usersData = [];
        $postsData = [];

        for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
            $date = Carbon::now()->format('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT);
            $dates[] = Carbon::parse($date)->format('d M');

            $usersData[] = User::whereDate('created_at', $date)->count();
            $postsData[] = Post::whereDate('created_at', $date)->count();
        }

        return view('admin.dashboard', compact('currentMonth', 'usersCount', 'postsCount', 'dates', 'usersData', 'postsData'));
    }
}

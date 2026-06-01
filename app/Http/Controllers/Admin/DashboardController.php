<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK REAL DATABASE
        |--------------------------------------------------------------------------
        */

        // Total user terdaftar
        $totalUsers = User::count();

        // Total transaksi pembayaran
        $totalTransactions = Payment::count();

        // Total seluruh pendapatan
        $totalRevenue = Payment::sum('total');

        // Rata-rata transaksi
        $averageTransaction = Payment::avg('total');

        // Transaksi terbaru
        $latestTransactions = Payment::with('user')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DETAIL DATA USER
        |--------------------------------------------------------------------------
        */

        $latestUsers = User::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTransactions',
            'totalRevenue',
            'averageTransaction',
            'latestTransactions',
            'latestUsers'
        ));
    }
}

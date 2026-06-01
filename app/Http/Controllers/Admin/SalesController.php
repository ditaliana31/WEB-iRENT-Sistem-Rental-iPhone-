<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class SalesController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | DATA PENJUALAN DARI DATABASE
        |--------------------------------------------------------------------------
        */

        // Ambil semua payment terbaru
        $payments = Payment::with([
            'user',
            'carts.product'
        ])
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        // Total transaksi
        $totalTransactions = Payment::count();

        // Total pendapatan
        $totalRevenue = Payment::sum('total');

        /*
        |--------------------------------------------------------------------------
        | KIRIM KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.sales.index', compact(
            'payments',
            'totalTransactions',
            'totalRevenue'
        ));
    }
}

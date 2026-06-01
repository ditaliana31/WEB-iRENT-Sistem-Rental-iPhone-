<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment; // 👈 INI WAJIB BENAR

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $payments = Payment::with(['carts.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $totalRental = $payments->count();
        $totalPaid = $payments->where('status', 'paid')->count();
        $totalActive = $payments->where('status', 'paid')->count();

        return view('pages.dashboard', compact(
            'payments',
            'totalRental',
            'totalPaid',
            'totalActive'
        ));
    }
}

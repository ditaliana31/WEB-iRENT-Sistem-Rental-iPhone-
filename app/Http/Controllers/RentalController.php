<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.dashboard', compact('rentals'));
    }
}

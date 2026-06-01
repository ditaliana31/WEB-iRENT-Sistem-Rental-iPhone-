<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS RENTAL
    |--------------------------------------------------------------------------
    */

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'rental_status' => 'required'
        ]);

        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'rental_status' => $request->rental_status
        ]);

        return back()->with('success', 'Status rental berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE RATING
    |--------------------------------------------------------------------------
    */

    public function storeRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string'
        ]);

        $transaction = Transaction::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | HANYA BISA RATING SETELAH SELESAI
        |--------------------------------------------------------------------------
        */

        if ($transaction->rental_status !== 'selesai') {

            return back()->with(
                'error',
                'Rating hanya bisa diberikan setelah rental selesai'
            );
        }

        $transaction->update([
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return back()->with(
            'success',
            'Terima kasih atas ratingnya'
        );
    }
}

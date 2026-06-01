<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->whereNull('payment_id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL
        |--------------------------------------------------------------------------
        */

        $grandTotal = $carts->sum('total');

        return view(
            'pages.pembayaran',
            compact('carts', 'grandTotal')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'payment_method' => 'required|string',

        ]);

        /*
        |--------------------------------------------------------------------------
        | AMBIL CART USER
        |--------------------------------------------------------------------------
        */

        $userId = Auth::id();

        $carts = Cart::with('product')
            ->where('user_id', $userId)
            ->whereNull('payment_id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | JIKA CART KOSONG
        |--------------------------------------------------------------------------
        */

        if ($carts->isEmpty()) {

            return redirect()
                ->route('keranjang')
                ->with('error', 'Keranjang kamu kosong!');
        }

        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL
        |--------------------------------------------------------------------------
        */

        $grandTotal = $carts->sum('total');

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PAYMENT
        |--------------------------------------------------------------------------
        */

        $payment = Payment::create([

            'user_id' => $userId,
            'payment_method' => $request->payment_method,
            'total' => $grandTotal,
            'status' => 'paid',

            /*
            |--------------------------------------------------------------------------
            | STATUS RENTAL DEFAULT
            |--------------------------------------------------------------------------
            */

            'rental_status' => 'belum_diambil',

        ]);

        /*
        |--------------------------------------------------------------------------
        | HUBUNGKAN CART KE PAYMENT
        |--------------------------------------------------------------------------
        */

        Cart::where('user_id', $userId)
            ->whereNull('payment_id')
            ->update([

                'payment_id' => $payment->id,

            ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT KE INVOICE
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('invoice', $payment->id)
            ->with('success', 'Pembayaran berhasil!');
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN INVOICE
    |--------------------------------------------------------------------------
    */

    public function invoice($id)
    {
        $payment = Payment::with([

            'user',
            'carts.product',

        ])->findOrFail($id);

        return view(
            'pages.invoice',
            compact('payment')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS RENTAL
    |--------------------------------------------------------------------------
    */

    public function updateStatus(Request $request, $id)
    {
        $request->validate([

            'rental_status' => 'required',

        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([

            'rental_status' => $request->rental_status,

        ]);

        return back()->with(
            'success',
            'Status rental berhasil diupdate'
        );
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
            'review' => 'nullable|string',

        ]);

        $payment = Payment::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | HANYA BISA RATING SETELAH RENTAL SELESAI
        |--------------------------------------------------------------------------
        */

        if ($payment->rental_status !== 'selesai') {

            return back()->with(
                'error',
                'Rating hanya bisa diberikan setelah rental selesai'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN RATING
        |--------------------------------------------------------------------------
        */

        $payment->update([

            'rating' => $request->rating,
            'review' => $request->review,

        ]);

        return back()->with(
            'success',
            'Terima kasih atas ratingnya'
        );
    }
}

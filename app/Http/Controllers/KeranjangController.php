<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN KERANJANG
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $grandTotal = $carts->sum('total');

        return view('pages.keranjang', compact(
            'carts',
            'grandTotal'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH KE KERANJANG
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI PRODUK RENTED
        |--------------------------------------------------------------------------
        */

        if ($product->status == 'Rented') {

            return back()->with(
                'error',
                'Produk sedang disewa dan tidak tersedia.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'duration' => 'required|integer|min:1',
            'start_date' => 'required|date',
        ]);

        $duration = (int) $request->duration;

        $total = $product->price * $duration;

        /*
        |--------------------------------------------------------------------------
        | CEK PRODUK SUDAH ADA DI KERANJANG
        |--------------------------------------------------------------------------
        */

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {

            return back()->with(
                'error',
                'Produk sudah ada di keranjang.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE KERANJANG
        |--------------------------------------------------------------------------
        */

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'duration' => $duration,
            'start_date' => $request->start_date,
            'total' => $total,
        ]);

        return redirect()
            ->route('keranjang')
            ->with(
                'success',
                'Produk berhasil ditambahkan ke keranjang.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE KERANJANG
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $cart = Cart::with('product')->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI USER
        |--------------------------------------------------------------------------
        */

        if ($cart->user_id != Auth::id()) {

            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'duration' => 'required|integer|min:1',
        ]);

        $duration = (int) $request->duration;

        $cart->update([
            'duration' => $duration,
            'total' => $cart->product->price * $duration,
        ]);

        return redirect()
            ->route('keranjang')
            ->with(
                'success',
                'Keranjang berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS KERANJANG
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI USER
        |--------------------------------------------------------------------------
        */

        if ($cart->user_id != Auth::id()) {

            abort(403);
        }

        $cart->delete();

        return redirect()
            ->route('keranjang')
            ->with(
                'success',
                'Produk berhasil dihapus dari keranjang.'
            );
    }
}

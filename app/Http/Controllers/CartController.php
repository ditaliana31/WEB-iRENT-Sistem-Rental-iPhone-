<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->whereNull('payment_id') // hanya cart aktif
            ->get();

        return view('pages.keranjang', compact('carts'));
    }

    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $duration = (int) $request->duration;

        $price = $product->price;
        $total = $price * $duration;

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,

            // SNAPSHOT (WAJIB UNTUK RIWAYAT)
            'product_name' => $product->name,
            'product_storage' => $product->storage,
            'price_snapshot' => $price,

            'duration' => $duration,
            'total' => $total,
        ]);

        return redirect()->route('keranjang');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->whereNull('payment_id')
            ->findOrFail($id);

        $duration = (int) $request->duration;

        // PAKAI SNAPSHOT, BUKAN PRODUCT LAGI
        $price = $cart->price_snapshot;

        $cart->update([
            'duration' => $duration,
            'total' => $price * $duration,
        ]);

        return redirect()->route('keranjang');
    }

    public function delete($id)
    {
        Cart::where('user_id', Auth::id())
            ->whereNull('payment_id')
            ->where('id', $id)
            ->delete();

        return redirect()->route('keranjang');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HOME
    |--------------------------------------------------------------------------
    */

    public function home()
    {
        // Produk terbaru
        $products = Product::latest()
            ->take(3)
            ->get();

        // Review customer dari database
        $reviews = Payment::with('user')
            ->whereNotNull('rating')
            ->whereNotNull('review')
            ->where('review', '!=', '')
            ->latest()
            ->take(3)
            ->get();

        return view('pages.index', compact(
            'products',
            'reviews'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | KATALOG
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $products = Product::latest()->get();

        return view('pages.katalog', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.detail', compact('product'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        Product::create($request->all());

        return redirect()->back();
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect()->back();
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->back();
    }
}

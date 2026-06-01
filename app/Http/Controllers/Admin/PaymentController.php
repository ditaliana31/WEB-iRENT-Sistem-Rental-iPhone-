<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['carts.product'])
            ->latest()
            ->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->rental_status = $request->rental_status;

        $payment->save();

        return redirect()->back()->with(
            'success',
            'Status rental berhasil diperbarui'
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')->latest()->get();
        $invoices = Invoice::with('user')->latest()->get();

        return view('admin.dashboard', compact('members', 'invoices'));
    }
    public function destroyInvoice($id)
{
    $invoice = Invoice::findOrFail($id);
    $invoice->delete();

    return redirect()->back()->with('success', 'Tagihan ' . $invoice->invoice_number . ' berhasil dihapus!');
}

    public function confirmPayment($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
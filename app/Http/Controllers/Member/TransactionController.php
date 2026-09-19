<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        // 1. Cek apakah user sudah punya tagihan yang pending, waiting, atau paid
        $existingInvoice = Invoice::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'waiting', 'paid'])
            ->first();

        if ($existingInvoice) {
            return redirect()->route('member.tagihan')->with('error', 'Kamu sudah memiliki paket aktif atau tagihan yang belum diselesaikan!');
        }

        $request->validate([
            'package_name' => 'required|string',
            'category'     => 'required|string',
            'amount'       => 'required|numeric',
        ]);

        Invoice::create([
            'user_id'        => auth()->id(),
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
            'package_name'   => $request->package_name,
            'category'       => $request->category,
            'amount'         => $request->amount,
            'status'         => 'pending',
            'due_date'       => Carbon::now()->addDays(3),
        ]);

        return redirect()->route('member.tagihan')->with('success', 'Paket berhasil dipilih! Silakan lakukan pembayaran dan unggah bukti transfer.');
    }

    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $invoice = Invoice::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($request->hasFile('proof_of_payment')) {
            $path = $request->file('proof_of_payment')->store('proofs', 'public');

            $invoice->update([
                'proof_of_payment' => $path,
                'status'           => 'waiting',
            ]);
        }

        return redirect()->route('member.tagihan')->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu konfirmasi admin.');
    }
}
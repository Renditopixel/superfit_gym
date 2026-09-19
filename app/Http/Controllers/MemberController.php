<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil tagihan/paket aktif milik member saat ini
        $activeSubscription = Invoice::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'waiting', 'paid'])
            ->latest()
            ->first();

        // Hitung BMI
        $height = $user->height ? $user->height / 100 : 0;
        $bmi = ($height > 0 && $user->weight) ? round($user->weight / ($height * $height), 1) : 0;

        $bmiStatus = ['label' => 'Belum Diisi', 'badge' => 'bg-secondary'];
        if ($bmi > 0) {
            if ($bmi < 18.5) {
                $bmiStatus = ['label' => 'Underweight', 'badge' => 'bg-warning text-dark'];
            } elseif ($bmi <= 24.9) {
                $bmiStatus = ['label' => 'Normal', 'badge' => 'bg-success'];
            } elseif ($bmi <= 29.9) {
                $bmiStatus = ['label' => 'Overweight', 'badge' => 'bg-warning text-dark'];
            } else {
                $bmiStatus = ['label' => 'Obesity', 'badge' => 'bg-danger'];
            }
        }

        $user->bmi = $bmi;
        $user->bmi_status = $bmiStatus;

        return view('dashboard', compact('user', 'activeSubscription'));
    }

    // Fungsi untuk membuat/memilih paket (Maksimal 1 paket aktif)
    public function subscribe(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'package_name' => 'required|string',
            'amount'       => 'required|numeric',
            'category'     => 'nullable|string', 
        ]);

        $user = Auth::user();

        // Cek jika member sudah punya paket yang pending, waiting, atau paid
        $existing = Invoice::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'waiting', 'paid'])
            ->first();

        if ($existing) {
            return redirect()->route('member.tagihan')->with('error', 'Anda sudah memiliki paket aktif atau transaksi yang sedang berjalan.');
        }

        // 2. Buat invoice baru dengan due_date
        Invoice::create([
            'invoice_number' => 'INV-' . strtoupper(uniqid()),
            'user_id'        => $user->id,
            'package_name'   => $request->package_name,
            'category'       => $request->category ?? 'Umum',
            'amount'         => $request->amount,
            'status'         => 'pending', 
            'due_date'       => Carbon::now()->addDays(3), // Ditambahkan agar tidak error due_date
        ]);

        return redirect()->route('member.tagihan')->with('success', 'Paket berhasil dipilih! Silakan lakukan pembayaran dan upload bukti transfer.');
    }

    public function tagihan()
    {
        $user = Auth::user();
        $invoices = Invoice::where('user_id', $user->id)->latest()->get();

        return view('member.tagihan', compact('invoices'));
    }

    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $invoice = Invoice::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('proof_of_payment')) {
            // Hapus file lama jika ada
            if ($invoice->proof_of_payment) {
                Storage::disk('public')->delete($invoice->proof_of_payment);
            }

            // Simpan gambar ke storage/app/public/proofs
            $path = $request->file('proof_of_payment')->store('proofs', 'public');

            // Update path gambar dan status
            // Jika database SQLite kamu menolak 'waiting', ganti 'waiting' menjadi 'pending'
            $invoice->update([
                'proof_of_payment' => $path,
                'status'           => 'pending', // Diubah sementara ke 'pending' agar SQLite tidak menolak CHECK constraint
            ]);
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu verifikasi admin.');
    }
}
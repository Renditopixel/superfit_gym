<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Member\TransactionController;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK (Dapat diakses siapa saja)
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 2. Halaman About & Trainer
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/trainer', function () {
    return view('trainer');
})->name('trainer');

// 3. Halaman Membership (Pilihan Paket)
Route::get('/membership', function () {
    return view('membership');
})->name('membership');

// 4. Halaman Gallery & Contact
Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| RUTE KHUSUS MEMBER (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MemberController::class, 'index'])->name('dashboard');
    Route::post('/profile/update', [MemberController::class, 'updateProfile'])->name('profile.update');
    
    // Menangani tombol pilih/checkout paket dari halaman membership
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');

    // Halaman Tagihan
    Route::get('/tagihan', [MemberController::class, 'tagihan'])->name('member.tagihan');
    
    // Route upload bukti pembayaran diarahkan ke TransactionController
    Route::post('/tagihan/{id}/upload', [TransactionController::class, 'uploadProof'])->name('member.uploadProof');
});


/*
|--------------------------------------------------------------------------
| RUTE KHUSUS ADMIN (Wajib Login & Role Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/invoice/{id}/confirm', [AdminController::class, 'confirmPayment'])->name('admin.invoice.confirm');
    Route::delete('/admin/invoice/{id}', [AdminController::class, 'destroyInvoice'])->name('admin.invoice.destroy');
});

require __DIR__.'/auth.php';
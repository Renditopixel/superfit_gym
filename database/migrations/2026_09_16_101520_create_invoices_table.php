<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->string('package_name');
            $table->string('category'); // Menampung kategori: Umum / Pelajar
            $table->integer('amount');
            // Menambahkan 'waiting' ke dalam enum status
            $table->enum('status', ['pending', 'waiting', 'paid', 'expired'])->default('pending');
            $table->string('proof_of_payment')->nullable(); // Kolom simpan bukti transfer
            $table->date('due_date');
            $table->date('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'package_name',
        'category', // Ditambahkan di sini
        'amount',
        'status',
        'proof_of_payment',
        'due_date',
        'paid_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
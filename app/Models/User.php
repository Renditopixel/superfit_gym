<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'height',
        'weight',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Perhitungan Nilai BMI Otomatis
    public function getBmiAttribute()
    {
        if ($this->height > 0) {
            $heightInMeters = $this->height / 100;
            return round($this->weight / ($heightInMeters * $heightInMeters), 1);
        }
        return 0;
    }

    // Kategori & Label Warna BMI
    public function getBmiStatusAttribute()
    {
        $bmi = $this->bmi;

        if ($bmi <= 0) {
            return ['label' => 'Belum Diisi', 'badge' => 'bg-secondary'];
        } elseif ($bmi < 18.5) {
            return ['label' => 'Kurus (Underweight)', 'badge' => 'bg-warning text-dark'];
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            return ['label' => 'Ideal (Normal)', 'badge' => 'bg-success'];
        } elseif ($bmi >= 25.0 && $bmi <= 29.9) {
            return ['label' => 'Gemuk (Overweight)', 'badge' => 'bg-warning text-dark'];
        } else {
            return ['label' => 'Obesitas (Obesity)', 'badge' => 'bg-danger'];
        }
    }

    // Relasi ke Tagihan
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
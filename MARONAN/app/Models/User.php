<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'address',
        'village',
        'farmer_id_number',
        'farm_address',
        'land_area',
        'main_commodity',
        'commitment_statement',
        'supporting_document',
        'verification_status',
        'verification_notes',
        'verified_at',
        'rejection_count',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    // 1 Petani memiliki banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPetani()
    {
        return $this->role === 'petani';
    }

    public function isApproved()
    {
        return $this->verification_status === 'approved';
    }
}
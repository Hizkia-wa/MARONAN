<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'category',
        'price',
        'stock',
        'unit',
        'image',
        'status',
        'warning_flag',
        'is_active',
    ];

    protected $casts = [
        'warning_flag' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Produk milik satu petani
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Produk memiliki banyak klik
    public function clickLogs()
    {
        return $this->hasMany(ClickLog::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available' && $this->is_active;
    }
}
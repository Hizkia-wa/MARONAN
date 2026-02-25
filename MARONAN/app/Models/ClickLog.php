<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClickLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'ip_address',
        'clicked_at',
    ];

    public $timestamps = false; // karena tidak pakai created_at & updated_at

    protected $casts = [
        'clicked_at' => 'datetime',
    ];

    // Klik milik satu produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
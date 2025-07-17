<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_visible',        // Status tampil di lokal (jika ada)
        'hub_category_id',   // ID kategori dari Hub
    ];

    /**
     * Relasi ke produk (1 kategori memiliki banyak produk)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

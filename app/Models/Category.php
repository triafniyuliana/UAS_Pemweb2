<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'is_visible',        // Status tampil di lokal (jika ada)
        'hub_category_id',   // ID kategori dari Hub
        'description',
        'is_active',
        'hub_category_id'
    ];

    /**
     * Relasi ke produk (1 kategori memiliki banyak produk)
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}

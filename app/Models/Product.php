<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'price',
        'stock',
        'sku',
        'image_url',
        'weight',
        'is_visible',      // Status tampil di lokal
        'hub_product_id',  // ID produk dari Hub
    ];

    /**
     * Relasi ke kategori (1 produk milik 1 kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

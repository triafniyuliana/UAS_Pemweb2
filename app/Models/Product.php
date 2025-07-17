<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'stock',
        'sku',
        'image',
        'weight',
        'is_visible',      
        'hub_product_id', 
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke kategori (1 produk milik 1 kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

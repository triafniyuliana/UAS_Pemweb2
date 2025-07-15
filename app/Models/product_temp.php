<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'is_visible',
        'hub_product_id'
    ];

    /**
     * Relasi ke kategori (opsional jika kamu punya model Category)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Jika kamu ingin mass-assignment (create/update) bisa langsung
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'status',
        'is_visible',
        'hub_product_id',
        'category_id',
        'store_id',
    ];

    /**
     * Relasi ke kategori (opsional jika kamu punya model Category)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke toko (opsional jika kamu punya model Store)
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

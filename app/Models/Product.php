<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'stock',
        'sku',
        'weight',
        'image',
        'category_id',
        'is_active',
        'hub_product_id'
    ];

        protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
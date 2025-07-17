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
        'image',
        'category_id',
        'is_visible',
        'hub_product_id'

    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
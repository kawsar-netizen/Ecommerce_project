<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'brand_id',
        'product_name',
        'product_slug',
        'price',
        'short_description',
        'long_description',
        'product_code',
        'image_one',
        'status',
        'image_two',
        'product_quantity',
        'image_three',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'unit_price'
    ];

    public function product_categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_product_category');
    }

    public function product_tags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_product_tag');
    }
}

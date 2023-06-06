<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'product_category_id',
    ];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_category');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($productCategory) {
            $productCategory->slug = Str::slug($productCategory->name);
        });

        static::updating(function ($productCategory) {
            $productCategory->slug = Str::slug($productCategory->name);
        });
    }
}

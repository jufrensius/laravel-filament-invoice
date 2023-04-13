<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($productTag) {
            $productTag->slug = Str::slug($productTag->name);
        });

        static::updating(function ($productTag) {
            $productTag->slug = Str::slug($productTag->name);
        });
    }
}

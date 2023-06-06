<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'customer_category_id',
    ];

    public function parent()
    {
        return $this->belongsTo(CustomerCategory::class, 'customer_category_id');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}

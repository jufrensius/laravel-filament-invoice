<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCustomerCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_category_id',
    ];
}

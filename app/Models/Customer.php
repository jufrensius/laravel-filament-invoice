<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'mobile_phone_number',
        'company_id',
    ];

    public function customer_categories()
    {
        return $this->belongsToMany(CustomerCategory::class, 'customer_customer_category');
    }

    public function customer_tags()
    {
        return $this->belongsToMany(CustomerTag::class, 'customer_customer_tag');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_customer')
            ->withPivot('position');
    }

    public function customer_orders()
    {
        return $this->hasMany(CustomerOrder::class);
    }
}

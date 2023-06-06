<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'logo',
        'name',
        'email',
        'phone_number',
        'mobile_phone_number',
        'address'
    ];

    public function company_categories()
    {
        return $this->belongsToMany(CompanyCategory::class, 'company_company_category');
    }

    public function company_tags()
    {
        return $this->belongsToMany(CompanyTag::class, 'company_company_tag');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'company_customer')
            ->withPivot('position');
    }
}

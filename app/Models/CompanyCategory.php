<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'company_category_id',
    ];

    public function parent()
    {
        return $this->belongsTo(CompanyCategory::class, 'company_category_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_company_category');
    }
}

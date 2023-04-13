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

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer_order';
    protected $fillable = [
        'customer_id',
        'order_id',
        'status_id',
        'payment_method_id',
        'due_date',
        'discount',
        'tax',
        'sub_total',
        'grand_total',
        'description',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}

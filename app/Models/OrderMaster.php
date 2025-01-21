<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    protected $fillable = [
        'date',
        'invoice_no',
        'customer_id',
        'user_id',
        'no_of_item',
        'order_status'
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_master_id');
    }
}

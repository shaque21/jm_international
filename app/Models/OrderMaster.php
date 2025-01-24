<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    protected $fillable = [
        'order_date',
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
    // Relationship with User (Customer)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    

    // Relationship with User (Creator/Employee/Admin)
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
    public function depo()
    {
        return $this->belongsTo(Depo::class, 'depo_id');
    }
}

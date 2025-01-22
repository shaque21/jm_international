<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_master_id',
        'product_id',
        'ordered_qty',
        'delivered_qty'
    ];

    public function orderMaster()
    {
        return $this->belongsTo(OrderMaster::class);
    }

    public function warehouseProductStock()
    {
        return $this->belongsTo(WarehouseProductStock::class, 'product_id');
    }
    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function depoProductStock()
    {
        return $this->belongsTo(DepoProductStock::class, 'product_id');
    }
    
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            OrderMaster::class,
            'id', // Foreign key on OrderMaster
            'id', // Foreign key on User
            'order_master_id', // Local key on OrderDetails
            'user_id' // Local key on OrderMaster
        );
    }

    // Relationship with Warehouse through OrderMaster
    public function warehouse()
    {
        return $this->hasOneThrough(
            Warehouse::class,
            OrderMaster::class,
            'id', // Foreign key on OrderMaster
            'id', // Foreign key on Warehouse
            'order_master_id', // Local key on OrderDetails
            'warehouse_id' // Local key on OrderMaster
        );
    }


}

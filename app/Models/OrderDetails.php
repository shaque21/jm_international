<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
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

    public function depoProductStock()
    {
        return $this->belongsTo(DepoProductStock::class, 'product_id');
    }

}

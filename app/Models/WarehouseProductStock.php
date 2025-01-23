<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseProductStock extends Model
{
    protected $fillable = [
        'warehouse_id',
        'total_stock',
        'product_id',
        // 'alert_stock',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function warehouseStock()
    {
        return $this->belongsTo(WarehouseStock::class, 'product_id', 'product_id');
    }

}

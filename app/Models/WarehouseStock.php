<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
    protected $fillable = [
        'warehouse_id',
        'user_id',
        'supplier_id',
        'product_id',
        'quantity',
        // 'alert_stock',
        'wr_status',
        'wr_slug',
    ];
    // Relationship with Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Relationship with Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with User (who created the stock)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

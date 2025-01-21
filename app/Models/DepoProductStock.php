<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepoProductStock extends Model
{
    protected $fillable = [
        'depo_id',
        'total_stock',
        'product_id',
        // 'alert_stock',
    ];

    public function depo()
    {
        return $this->belongsTo(Depo::class, 'depo_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'warehouse_status',
        'warehouse_slug',
    ];

    public function stocks()
    {
        return $this->hasMany(WarehouseStock::class);
    }
}

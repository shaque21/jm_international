<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depo extends Model
{
    protected $fillable = [
        'depo_name',
        // 'warehouse_id',
        'depo_slug',
        'depo_status',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
}

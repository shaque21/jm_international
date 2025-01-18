<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'generic_name', 'packing', 'specification',
        'product_img',  'product_slug', 'product_status'
    ];
    public function stocks()
    {
        return $this->hasMany(WarehouseStock::class);
    }
}


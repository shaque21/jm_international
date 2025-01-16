<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $fillable=[
        'sup_name',
        'company_name',
        'address',
        'mobile',
        'email',
        'supplier_slug',
        'supplier_status'
    ];
    public function stocks()
    {
        return $this->hasMany(WarehouseStock::class);
    }


}

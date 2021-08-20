<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $fillable =[
        'orders_id',
        'products_id',
    ];
    public function orders()
    {
        return $this->belongsToMany(Orders::class);
    }
    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
    
    public $timestamps = false;
}

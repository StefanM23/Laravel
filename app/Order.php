<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function product()
    {
        return $this->belongsToMany(Product::class)->as('pivot')->withPivot('price');
    }
}

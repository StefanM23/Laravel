<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
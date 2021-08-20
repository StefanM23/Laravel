<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function items()
    {
        return $this->hasMany(Items::class);
    }
}

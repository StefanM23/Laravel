<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{

    public function products()
    {
        return $this->belongsTo(Products::class);
    }

    public $timestamps = false;
}
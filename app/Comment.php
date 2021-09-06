<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['product_id', 'comment','accepted'];
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

}
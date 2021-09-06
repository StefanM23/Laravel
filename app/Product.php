<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    protected $table = 'products';
    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
    ];
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function comment()
    {
        return $this->hasMany(comment::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
}

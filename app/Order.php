<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'customer_name',
        'customer_address',
        'customer_comment',
        'create_date',
    ];

    public $timestamps = false;
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function product()
    {
        return $this->belongsToMany(Product::class)->as('pivot')->withPivot('price');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

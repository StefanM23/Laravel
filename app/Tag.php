<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['name'];
    
    /**
     * Get all of the products that are assined this tag
     */
    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    public function orders()
    {
        return $this->morphedByMany(Order::class, 'taggable');
    }
    
}

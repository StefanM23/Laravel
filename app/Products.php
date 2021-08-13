<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function modifie($title)
    {
        $this->title = $title;
        $this->save();
    }
    public function add($image, $title, $description, $price)
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->save();
    }
    public $timestamps = false;
}

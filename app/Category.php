<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function getCategories()
    {
        return Category::all();
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public static function getCategory($id)
    {
        return Category::where('id', '=', $id)->first();
    }

    public static function getCategories()
    {
        return Category::withCount('posts')->get();
    }

    public static function getToSelect()
    {
        $categoriesData = [];
        $categories = Category::getCategories();

        foreach ($categories as $category) {
            $categoriesData[strval($category->id)] = $category->name;
        }

        return $categoriesData;
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}

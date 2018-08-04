<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name'];

    public static function getToSelect()
    {
        $authorsData = [];
        $authors = Author::all();

        foreach ($authors as $author) {
            $authorsData[strval($author->id)] = $author->name;
        }

        return $authorsData;
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}

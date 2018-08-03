<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const PER_PAGE = 5;

    protected $fillable = ['author', 'email', 'text', 'post_id'];

    public static function get($post, $perPage)
    {
        return $post->comments()->paginate($perPage);
    }

    public function getCreatedAtAttribute($value)
    {
        $date = \Carbon\Carbon::parse($value)->format('j %n% Y, в H:i');

        return preg_replace_callback('/%([0-9]{1,2})%/', function ($matches) {
            $months = [
                'Января', 'Февраля', 'Марта', 'Декабря',
                'Апреля', 'Мая', 'Июня', 'Июля',
                'Августа', 'Сенятбря', 'Октября', 'Ноября'
            ];

            return $months[$matches[1] - 1];
        }, $date);
    }

    public function getImageAttribute() {
        $email = $this->attributes['email'];

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email)));
    }

    public function post()
    {
        return $this->belongsTo('App\\Post');
    }
}

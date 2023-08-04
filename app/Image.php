<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'imagen';

    //Relacion uno a muchos
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    //Relacion de muchos a uno
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }
}

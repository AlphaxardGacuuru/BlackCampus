<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function postLikes()
    {
        return $this->hasMany('App\PostLikes', 'post_id');
    }

    public function postComments()
    {
        return $this->hasMany('App\PostComments', 'post_id');
    }
}

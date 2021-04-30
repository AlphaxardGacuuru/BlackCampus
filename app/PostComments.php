<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post_comment_likes()
    {
        return $this->hasMany('App\PostCommentLikes', 'comment_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Posts');
    }
}

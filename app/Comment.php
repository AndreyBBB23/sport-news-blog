<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fallible = ['post_id', 'name', 'email', 'website', 'comment'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

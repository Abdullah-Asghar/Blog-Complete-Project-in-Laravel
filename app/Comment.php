<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(){
    return $this->hasMany(Comment::class);
    }
    public function user(){
        return $this->hasMany(Post::class);
    }
}

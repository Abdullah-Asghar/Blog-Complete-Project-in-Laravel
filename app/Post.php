<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function like(){
        return $this->hasMany(Like::class);
    }
    public function profile()
    {
        return $this->belongsTo(Like::class);
    }
}

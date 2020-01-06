<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}

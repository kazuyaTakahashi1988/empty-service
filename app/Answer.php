<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'id', 'comment_id', 'post_id'
    ];
    
    public function comment(){
     return $this->belongsTo(\App\Comment::class,'comment_id');
    }

}

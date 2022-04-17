<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'post_id', 'comment'
    ];

    public function user(){
     return $this->belongsTo(\App\User::class,'user_id');
    }
}

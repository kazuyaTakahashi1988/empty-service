<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
       'id', 'user_id', 'category_id', 'content', 'title', 'image'
    ];

    public function category(){
      // 投稿は1つのカテゴリーに属する
      return $this->belongsTo(\App\Category::class,'category_id');
    }

    public function user(){
      return $this->belongsTo(\App\User::class,'user_id');
    }

    public function answer(){
      return $this->belongsTo(\App\Answer::class, 'id', 'post_id');
    }

    public function comments(){
      return $this->hasMany(\App\Comment::class,'post_id', 'id');
    }

    public function loops(){
      return $this->hasMany(\App\Loop::class,'post_id', 'id');
    }

    public function likes(){
        // いいね用リレーション
        return $this->hasMany('App\Like', 'post_id', 'id');
    }

    // public function tags()
    // {
    //     return $this->belongsToMany('App\Tag')->withTimestamps();
    // }

}

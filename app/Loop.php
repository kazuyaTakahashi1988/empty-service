<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loop extends Model
{
    protected $fillable = [
        'post_id', 'image', 'lavel'
    ];
}

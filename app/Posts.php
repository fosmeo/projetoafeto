<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
    	'posts_titulo',
		'posts_texto',
		'posts_imagem',
		'posts_video',
    ];
     
     protected $hidden = [
		'remember_token'
    ];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
    	'posts_id',
    	'comments_nome',
		'comments_texto',
    ];
    
     protected $hidden = [
		'remember_token'
    ];
}

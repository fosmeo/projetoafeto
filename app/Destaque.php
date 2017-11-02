<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destaque extends Model
{
    protected $fillable = [
    	'posts_id',
    	'destaque_titulo',
		'destaque_texto',
		'destaque_fotos',
    ];
    
     protected $hidden = [
		'remember_token'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
    	'posts_id',
    	'footer_linha1',
		'footer_linha2',
		'footer_linha3',
		'footer_linha4',
    ];
    
     protected $hidden = [
		'remember_token'
    ];
}

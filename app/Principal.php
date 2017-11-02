<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    protected $fillable = [
    	'posts_id',
    	'principal_titulo',
		'principal_texto',
    ];
    
     protected $hidden = [
		'remember_token'
    ];
}

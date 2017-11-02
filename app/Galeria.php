<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $fillable = [
    	'galeria_descricao', 
    	'galeria_imagem',
    ];
    
    protected $hidden = [
		'remember_token'
    ];
}

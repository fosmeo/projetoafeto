<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    protected $fillable = [
    	'pessoas_nome',
		'pessoas_data_nasc',
		'pessoas_idade',
		'pessoas_endereco',
		'pessoas_tel1',
		'pessoas_tel2',
		'pessoas_tel3',
		'pessoas_filhos',
		'pessoas_local_trabalho',
		'pessoas_tel_local_trabalho',
		'pessoas_sit_matrimonial',
		'pessoas_marido',
		'pessoas_prenatal',
		'pessoas_semana_gestacional',
		'pessoas_data_parto',
		'pessoas_tipo_parto',
		'pessoas_data_assist',
		'pessoas_acompanhante',
		'pessoas_email',
		'pessoas_imagem',
		'pessoas_obs',
    ];
     
     protected $hidden = [
		'remember_token'
    ];   
}
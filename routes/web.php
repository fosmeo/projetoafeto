<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::Auth();

Route::get('/', 'HomeController@index')->name('index');
Route::get('gerenciador', 'HomeController@gerenciador')->name('gerenciador');
Route::get('pesquisar', 'HomeController@pesquisar')->name('pesquisar');
Route::get('{from}/recalcular_comments', 'HomeController@recalcular') -> name ('recalcular');
Route::get('post/{id}', 'HomeController@simplepage')->name('post');

Route::post('{id}', 'CommentsController@salvar')->name('salvar_comments');

Route::get('galeria', 'GaleriaController@index') -> name ('galeria');

Route::group(['prefix' => 'pessoas'], function(){
	Route::get('lista_pessoas', 'PessoasController@lista') -> name ('lista_pessoas');
	Route::get('pesquisar_pessoas', 'PessoasController@pesquisa') -> name ('pesquisar_pessoas');
	Route::get('formulario_pessoas', 'PessoasController@inserir') -> name ('formulario_pessoas');
	Route::post('salvar_pessoas', 'PessoasController@salvar') -> name ('salvar_pessoas');
	Route::get('{id}/editar_pessoas', 'PessoasController@editar') -> name ('editar_pessoas');
	Route::patch('{id}', 'PessoasController@atualizar') -> name ('atualizar_pessoas');
	Route::delete('{id}', 'PessoasController@excluir') -> name ('excluir_pessoas');
	Route::get('{id}/excluir_foto_pessoas', 'PessoasController@excluir_foto') -> name ('excluir_foto_pessoas');
});

Route::group(['prefix' => 'site'], function(){
	Route::get('formulario_site', 'SiteController@gerenciador') -> name ('formulario_site_gerenciador');
	Route::patch('{area}/{id}', 'SiteController@atualizar') -> name ('formulario_site_atualizar');
	Route::post('salvar_principal', 'SiteController@salvar_principal') -> name ('salvar_principal');
	Route::post('salvar_destaque', 'SiteController@salvar_destaque') -> name ('salvar_destaque');
	Route::post('salvar_footer', 'SiteController@salvar_footer') -> name ('salvar_footer');
});

Route::group(['prefix' => 'galeria'], function(){
	Route::get('formulario_galeria', 'GaleriaController@gerenciador') -> name ('formulario_galeria_gerenciador');
	Route::patch('{id}', 'GaleriaController@atualizar') -> name ('formulario_galeria_atualizar');
	Route::post('salvar_galeria', 'GaleriaController@salvar') -> name ('salvar_galeria');
	Route::get('{id}/excluir_galeria', 'GaleriaController@excluir_foto') -> name ('excluir_galeria');

});

Route::group(['prefix' => 'blog'], function(){
	Route::get('lista_posts', 'BlogController@lista') -> name ('lista_posts');
	Route::get('pesquisar_posts', 'BlogController@pesquisa') -> name ('pesquisar_posts');
	Route::get('formulario_posts', 'BlogController@inserir') -> name ('formulario_posts');
	Route::post('salvar_posts', 'BlogController@salvar') -> name ('salvar_posts');
	Route::get('{id}/editar_posts', 'BlogController@editar') -> name ('editar_posts');
	Route::patch('{id}', 'BlogController@atualizar') -> name ('atualizar_posts');
	Route::delete('{id}', 'BlogController@excluir') -> name ('excluir_posts');
	Route::get('{id}/excluir_foto_posts', 'BlogController@excluir_foto') -> name ('excluir_foto_posts');
	Route::get('{id}/excluir_comments', 'BlogController@excluir_comments')->name('excluir_comments');	
});
	




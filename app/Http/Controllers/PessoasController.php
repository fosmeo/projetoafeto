<?php

namespace App\Http\Controllers;

use App\Pessoas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;


class PessoasController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	function gerenciador()
	{
		return view('pessoas.gerenciador');
	}

	function lista()
	{
		$pessoas = Pessoas::orderBy('pessoas_nome') -> paginate(50);
		$total = Pessoas::orderBy('pessoas_nome') -> get() -> count();
		return view('pessoas.listapessoas', ['pessoas' => $pessoas, 'total' => $total]);
	}

	function pesquisa(Request $request)
	{

		$pessoas_nome = $request->input('pesquisa_nome');
		$pessoas_pesquisar = Pessoas::where('pessoas_nome', 'like', '%'.$pessoas_nome.'%') ->orderBy('pessoas_nome') -> paginate(50);
		$total = count($pessoas_pesquisar);
		return view('pessoas.listapessoas', ['pessoas' => $pessoas_pesquisar, 'total' => $total]);
	}

	function inserir()
	{
		return view('pessoas.formulario');
	}


	function salvar(Request $request)
	{

    	$this -> validate($request,[
			'pessoas_nome' => ['required'],
    	]);

		$pessoas_salvar = new Pessoas();
		$pessoas_salvar -> create($request -> all());

		if($request->hasFile('pessoas_imagem')) // VERIFICA SE EXISTE FOTO E INSERE IMAGEM NO DISCO E NO BANCO DE DADOS
		{
			$extensao = $request -> pessoas_imagem -> getClientOriginalExtension();
			$nome_imagem = time().'.'.$extensao;
			$request-> pessoas_imagem -> storeAs('imagens_pessoas/', $nome_imagem);
			$temp = $request -> pessoas_imagem -> getPathname();
			$pessoas_salvar = Pessoas::where('pessoas_imagem', 'like', $temp) ;
			$pessoas_salvar -> update(['pessoas_imagem' => $nome_imagem]);
		}
		
		\Session::flash('flashmsg', 'Pessoa Cadstrado com Sucesso - ');
		\Session::flash('msg_nome', $request -> pessoas_nome);
		return redirect() -> route('lista_pessoas');
	}

	function editar($id)
	{
		$pessoa_editar = Pessoas::findorfail($id);
		return view('pessoas.formulario', ['pessoa_editar_form' => $pessoa_editar]);
	}

	function atualizar($id, Request $request)
	{
		$this -> validate($request,[
			'pessoas_nome' => ['required'],
    	]);
    	
		$pessoa_atualizar = Pessoas::findorfail($id);
		
		if($request->hasFile('pessoas_imagem')) // VERIFICA SE EXISTE FOTO, EXCLUI A ATUAL E INSERE NOVA IMAGEM NO DISCO E NO BANCO DE DADOS
		{
			if(!is_null($pessoa_atualizar -> pessoas_imagem))
			{
				File::delete('imagens/imagens_pessoas/'.$pessoa_atualizar -> pessoas_imagem);
			}

			$extensao = $request -> pessoas_imagem -> getClientOriginalExtension();
			$nome_imagem = time().'.'.$extensao;
			
			$request-> pessoas_imagem -> storeAs('imagens_pessoas/', $nome_imagem);
			$temp = $request -> pessoas_imagem -> getPathname();

			$pessoa_atualizar -> update($request -> all());
			$pessoas_salvar = Pessoas::where('pessoas_imagem', 'like', $temp) ;
			$pessoas_salvar -> update(['pessoas_imagem' => $nome_imagem]);
			
		}else{

			$pessoa_atualizar -> update($request -> all());
		}

		\Session::flash('flashmsg', 'Pessoa Atualizada com Sucesso');
		return redirect() -> route('lista_pessoas');
		// return view('pessoas.formulario', ['pessoa_editar_form' => $pessoa_atualizar]); NAO USAR!!!!!!!!!
	}

	function excluir($id){
		$pessoa_excluir = Pessoas::findorfail($id);
		$pessoa_excluir -> delete();
		File::delete('imagens/imagens_pessoas/'.$pessoa_excluir -> pessoas_imagem);
		\Session::flash('flashmsg', 'Cliente Excluido com Sucesso - ');
		\Session::flash('msg_nome', $pessoa_excluir -> pessoas_nome);
		return redirect() -> route('lista_pessoas');

	}

	function excluir_foto($id){
		$pessoa_excluir_foto = Pessoas::findorfail($id);
		File::delete('imagens/imagens_pessoas/'.$pessoa_excluir_foto -> pessoas_imagem);
		$pessoa_excluir_foto -> update(['pessoas_imagem' => '']);
		\Session::flash('flashmsg', 'Foto Removida com Sucesso');
		return redirect() -> route('lista_pessoas');
	}
}

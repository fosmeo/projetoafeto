<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeria;
use App\Footer;
use File;

class GaleriaController extends Controller
{

	function index(){
		$galeria_imagens = Galeria::orderBy('id', 'DESC') -> paginate(8);
		$footer = Footer::get();
    	return view('galeria', ['galerias' => $galeria_imagens, 'footers' => $footer]);
	}

    function gerenciador(){
    	$galeria_imagens = Galeria::orderBy('id','DESC') -> get();
    	return view('galeria.gerenciador_galeria', ['galerias' => $galeria_imagens]);
    }

    function atualizar(){
    	echo "updt";	
    }

    function salvar(Request $request){

        $this -> validate($request,[
            'galeria_imagem' => ['required']
        ]);

    	$galeria_salvar = new Galeria();
    	$galeria_salvar -> create($request -> all());

		if($request->hasFile('galeria_imagem')) // VERIFICA SE EXISTE FOTO E INSERE IMAGEM NO DISCO E NO BANCO DE DADOS
		{
			$extensao = $request -> galeria_imagem -> getClientOriginalExtension();
			$nome_imagem = time().'.'.$extensao;
			$request-> galeria_imagem -> storeAs('imagens_galeria/', $nome_imagem);
			$temp = $request -> galeria_imagem -> getPathname();
			$galeria_salvar = Galeria::where('galeria_imagem', 'like', $temp);
			$galeria_salvar -> update(['galeria_imagem' => $nome_imagem]);
		}
		
		$galeria_imagens = Galeria::orderBy('id','DESC') -> get();		
        \Session::flash('flashmsg', 'Foto Adicionada com Sucesso');
		return redirect() -> route('formulario_galeria_gerenciador');

    }

    function excluir_foto($id){
        $galeria_excluir_foto = Galeria::findorfail($id);
        $galeria_excluir_foto -> delete();
        File::delete('imagens/imagens_galeria/' . $galeria_excluir_foto -> galeria_imagem);
        \Session::flash('flashmsg', 'Foto Removida com Sucesso');
        return redirect() -> route('formulario_galeria_gerenciador');
    }
}

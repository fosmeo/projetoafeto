<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Comments;
use App\Footer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class BlogController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth');
    }

    function gerenciador(){
        return view('blog.gerenciador');
    }

    function inserir()
    {
    	return view('blog.formulario');
    }    


    function lista()
    {
        $posts = Posts::orderBy('id' , 'DESC') -> paginate(50) ;
        $total = Posts::orderBy('id') -> count();
        return view('blog.listaposts', ['posts' => $posts, 'total' => $total]);
    }    


    function salvar(Request $request)
    {
        $this -> validate($request,[
            'posts_titulo' => ['required'],
            'posts_texto' => ['required']
        ]);

        $posts_salvar = new Posts();
        $posts_salvar -> create($request -> all());

        if($request->hasFile('posts_imagem')) // VERIFICA SE EXISTE FOTO E INSERE IMAGEM NO DISCO E NO BANCO DE DADOS
        {
            $extensao = $request -> posts_imagem -> getClientOriginalExtension();
            $nome_imagem = time().'.'.$extensao;
            $request-> posts_imagem -> storeAs('imagens_posts/', $nome_imagem);
            // File::put( 'imagens/imagens_posts/' . $nome_imagem, $request-> posts_imagem );
            $temp = $request -> posts_imagem -> getPathname();
            $posts_salvar = Posts::where('posts_imagem', 'like', $temp);
            $posts_salvar -> update(['posts_imagem' => $nome_imagem]);
        }
        
        \Session::flash('flashmsg', 'Postado com Sucesso');
        return redirect() -> route('lista_posts');
    }
    


    function pesquisa(Request $request)
    {
        $posts_input = $request->input('pesquisa_post');
        $from = $request->input('from');

        $tipopesquisa = 'posts_titulo';
        $like = $posts_input;

        $total = Posts::where($tipopesquisa, 'like', '%'.$like.'%') ->orderBy($tipopesquisa) -> get() -> count();
        $posts_pesquisar = Posts::where($tipopesquisa, 'like', '%'.$like.'%') ->orderBy($tipopesquisa) -> paginate(50);

        return view('blog.listaposts', ['posts' => $posts_pesquisar, 'total' => $total] );        
    }


    function editar($id)
    {
        $posts_editar = Posts::findorfail($id);
        $comments_editar =  Comments::where('posts_id', '=', $id) -> orderBy('created_at', 'DESC') -> get();
        return view('blog.formulario', ['posts_editar_form' => $posts_editar, 'comments_editar_form' => $comments_editar]);
    }

    

    function atualizar($id, Request $request)
    {
        $this -> validate($request,[
            'posts_titulo' => ['required'],
            'posts_texto' => ['required']
        ]);


        $posts_atualizar = Posts::findorfail($id);
        
        if($request->hasFile('posts_imagem')) // VERIFICA SE EXISTE FOTO, EXCLUI A ATUAL E INSERE NOVA IMAGEM NO DISCO E NO BANCO DE DADOS
        {
            if(!is_null($posts_atualizar -> posts_imagem))
            {
                File::delete('imagens/imagens_posts/'.$posts_atualizar -> posts_imagem);
            }

            $extensao = $request -> posts_imagem -> getClientOriginalExtension();
            $nome_imagem = time().'.'.$extensao;
            
            $request-> posts_imagem -> storeAs('imagens_posts/', $nome_imagem);
            // File::put( 'imagens/imagens_posts/' . $nome_imagem, $request-> posts_imagem );
            $temp = $request -> posts_imagem -> getPathname();

            $posts_atualizar -> update($request -> all());
            $posts_salvar = Posts::where('posts_imagem', 'like', $temp) ;
            $posts_salvar -> update(['posts_imagem' => $nome_imagem]);
            
        }else{

            $posts_atualizar -> update($request -> all());
        }

        \Session::flash('flashmsg', 'Post Atualizado');
        return redirect() -> route('lista_posts');
    }



    function excluir($id)
    {
        $posts_excluir = Posts::findorfail($id);
        $posts_excluir -> delete();
        $comments_excluir = Comments::where('posts_id', '=', $id) -> delete();
        // File::delete('imagens/imagens_posts/'.$posts_excluir -> posts_imagem);
        File::delete('imagens/imagens_posts/'.$posts_excluir -> posts_imagem);
        \Session::flash('flashmsg', 'Post Excluido com Sucesso');
        return redirect() -> route('lista_posts');
    }

    function excluir_foto($id){
        $posts_excluir_foto = Posts::findorfail($id);
        // File::delete('imagens/imagens_posts/'.$posts_excluir_foto -> posts_imagem);
        File::delete('imagens/imagens_posts/'.$posts_excluir_foto -> posts_imagem);
        $posts_excluir_foto -> update(['posts_imagem' => '']);
        \Session::flash('flashmsg', 'Foto Removida com Sucesso');
        return redirect() -> route('lista_posts');
    }

    function excluir_comments($id){

        $comments_excluir = Comments::findorfail($id);
        $comments_excluir -> delete();
        \Session::flash('flashmsg', 'Comentario Excluido com Sucesso');
        return redirect(url('lista/recalcular_comments'));

    }

}

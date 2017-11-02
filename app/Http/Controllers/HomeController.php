<?php

namespace App\Http\Controllers;
use App\Posts;
use App\Comments;
use App\Principal;
use App\Destaque;
use App\Footer;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {    
        $principal = Principal::get();
        $footer = Footer::get();
        $posts = Posts::orderBy('id', 'DESC') -> paginate(10);
        $comments = Comments::orderBy('posts_id') -> get();
        $maiscomentados = DB::select("SELECT comments.posts_id, posts.posts_titulo, COUNT(posts_id) as contador FROM comments INNER JOIN posts ON posts.id = comments.posts_id  GROUP BY posts_id order by contador DESC LIMIT 8;");
        ;
        return view('welcome', ['footers' => $footer, 'principals' => $principal, 'posts' => $posts, 'comments' => $comments, 'maiscomentados' => $maiscomentados]);

    }

    public function simplepage($id)
    {
        if ($id == "main"){
            $destaque = Destaque::get();
            $footer = Footer::get();
            return view ('destaque' , ['destaques' => $destaque, 'footers' => $footer]);

        }elseif ($id == "colabore"){
            $footer = Footer::get();
            return view ('colabore', ['footers' => $footer]);

        }else{
            $posts = Posts::where('id', 'like', $id) -> get();
            $comments = Comments::where('posts_id', 'like', $id) -> get();
            $footer = Footer::get();
            return view ('simplepage' , ['posts' => $posts , 'comments' => $comments, 'footers' => $footer]);
        }
    }


    public function gerenciador()
    {
        return view('gerenciador');
    }

    public function recalcular($from)
    {
        $posts = Posts::orderBy('id') -> get();
        // ROTINA MANUTENÇÃO PARA PREENCHER O TOTAL DE COMMENTS NO DB Posts
        $posts_sav = New Posts();
        foreach ($posts as $post) {
            $total_com = Comments::where('posts_id', 'like', $post -> id) -> count();
            $posts_sav = Posts::where('id', 'like', $post -> id);
            $posts_sav -> update(['posts_total_comments' => $total_com]);
        }
        if($from == 'home'){
            \Session::flash('flashmsg', 'Seu Comentário foi Enviado');
            return redirect('/');
        }else{
            return redirect() -> route('lista_posts');
        }
    }

        function pesquisar(Request $request)
    {
        $posts_input = $request->input('pesquisa_post');
        $from = $request->input('from');

        $tipopesquisa = 'posts_titulo';
        $like = $posts_input;

        $posts_pesquisar = Posts::where($tipopesquisa, 'like', '%'.$like.'%') ->orderBy($tipopesquisa) -> paginate(50);

        $footer = Footer::get();
        return view('pesquisa', ['posts' => $posts_pesquisar, 'footers' => $footer]);
        
    }
}

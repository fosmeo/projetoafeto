<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comments;
use App\Posts;

class CommentsController extends Controller
{
    // public function __construct()
    //    {
    // 	$this->middleware('auth');
    //    }

    function salvar($id, Request $request)
    {
    
        $this -> validate($request,[
            'comments_nome' => ['required'],
            'comments_texto' => ['required']
        ]);

        // $posts_total = new Posts();
        // $posts_total = Posts::findorfail($id);
        // $total_anterior = ($posts_total -> posts_total_comments);
        // $total_atual = $total_anterior + 1;
        // $post_updt= $posts_total -> where('id', '=', $id);
        // $post_updt -> update(['posts_total_comments' => $total_atual]);

        $comments_salvar = new Comments();
        $comments_salvar -> create($request -> all());

        return redirect(url('home/recalcular_comments'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Principal;
use App\Destaque;
use App\Footer;


class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    function gerenciador()
    {
	    	$site_principal = Principal::first();
	    	$site_destaque = Destaque::first();
	    	$site_footer = Footer::first();

	        return view('site.site', ['principals' => $site_principal, 'destaques' => $site_destaque, 'footers' => $site_footer]);
        
    }

	function atualizar(Request $request, $area, $id)
    {
    	if($area == "principal"){
    		$principal_atualizar = Principal::findorfail($id);
    		$principal_atualizar -> update($request -> all());
			\Session::flash('flashmsg', 'Página PRINCIPAL Salva com Sucesso');    		

    	}elseif($area == "destaque"){
    		$destaque_atualizar = Destaque::findorfail($id);
    		$destaque_atualizar -> update($request -> all());
    		\Session::flash('flashmsg', 'Página DESTAQUE Salva com Sucesso');

    	}elseif($area == "footer"){
    		$footer_atualizar = Footer::findorfail($id);
    		$footer_atualizar -> update($request -> all());
    		\Session::flash('flashmsg', 'RODAPÉ Salvo com Sucesso');
    	}
    	
    	return redirect() -> route('formulario_site_gerenciador');

    }


    function salvar_principal(Request $request)
    {

    	$principal_salvar = new Principal();
        $principal_salvar -> create($request -> all());

        \Session::flash('flashmsg', 'Página Principal Salva com Sucesso');
        return redirect() -> route('formulario_site_gerenciador');
    }

    function salvar_destaque(Request $request)
    {
    	$destaque_salvar = new Destaque();
        $destaque_salvar -> create($request -> all());

        \Session::flash('flashmsg', 'Página Destaque Salva com Sucesso');
        return redirect() -> route('formulario_site_gerenciador');
    }

    function salvar_footer(Request $request)
    {
    	$footer_salvar = new Footer();
        $footer_salvar -> create($request -> all());

        \Session::flash('flashmsg', 'Rodapé Salvo com Sucesso');
        return redirect() -> route('formulario_site_gerenciador');
    }


}

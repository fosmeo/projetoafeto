@extends('layouts.gerenciadorLayout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (!Auth::guest())
                        <h3>BEM VINDO! Você está ONLINE</h3>
                            <br>
                        <ul>
                            <li>BLOG</li>
                            <li><a class="pull-left marginsH" href="{{ route('lista_posts') }}">Listar Posts</a></li>
                            <li><a class="pull-left marginsH" href="{{ route('formulario_posts') }}">Inserir Novo Post</a></li>
                            <li><a class="pull-left marginsH" href="{{ url('true/recalcular_comments') }} ">Recalcular Comentários (manutenção)</a></li>
                        <br>
                            <li>PESSOAS</li>
                            <li><a class="pull-left marginsH" href="{{ route('lista_pessoas') }}">Listar Pessoas</a></li>
                            <li><a class="pull-left marginsH" href="{{ route('formulario_pessoas') }}">Cadastrar Nova Pessoa</a></li>
                        <br>
                            <li>SITE</li>
                            <li><a class="pull-left marginsH" href="{{ route('formulario_site_gerenciador') }}">Gerenciar Conteúdo do Site</a></li>
                            <li><a class="pull-left marginsH" href="{{ route('formulario_galeria_gerenciador') }}">Gerenciar Galeria de Fotos</a></li>
                        <br>
                            <li>ADMIN</li>
                            <li><a class="pull-left marginsH" href="{{ url('register') }}">Cadastrar Usuário do Sistema</a></li>
                            <li><a class="pull-left marginsH" href="{{ url('password/reset/') }}">Reset Password</a></li>
                    @else
                        <h3>Você está OFFLINE</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
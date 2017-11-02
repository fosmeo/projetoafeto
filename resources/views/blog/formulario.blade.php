@extends('layouts.gerenciadorLayout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>CADASTRO DE POSTS</h2>
                    <a class="pull-right marginsH" href="{{ route('lista_posts') }}">Lista de Posts</a>
                    <br>
                </div>

                <div class="panel-body">

                    @if (!empty($errors -> all()))
                        <div class="alert alert-danger">{{ $errors -> first() }}</div>
                    @endif

                    @if(Request::is('*/editar_posts'))

                        {!! Form::model($posts_editar_form, ['url' => 'blog/'.$posts_editar_form -> id , 'method' => 'PATCH', 'files' => true, 'class' => 'form-inline']) !!}

                         <h4>{{ $posts_editar_form -> posts_imagem }}</h4>  <!-- LABEL IMAGEM-->

                         @if(empty($posts_editar_form -> posts_imagem))
                            <div class="pull-right col-md-4">
                                <p class="text-center" style="height:180px;border:3px solid #ccc;">Sem foto para exibir</p>
                            </div>
                        @else
                            <div class="text-center pull-right col-md-4">
                                <img style="height:180px;width:210px;border:3px solid #ccc;" src="{{ asset('imagens/imagens_posts/'.$posts_editar_form -> posts_imagem)}}" >
                                <br>
                                <a href="excluir_foto_posts" onclick="return confirm('Tem certeza que deseja excluir essa FOTO?')">Remover Foto</a>
                            </div>
                        @endif

                    @else

                        {!! Form::open(['url' => 'blog/salvar_posts', 'method' => 'POST', 'files' => true, 'class' => 'form-inline']) !!}

                    @endif
                        
                        {{ csrf_field() }}

                        <div class="form-group marginsV col-md-12 oneline-input">

                            
                            {!! Form::label('imagem','Adicionar Foto:') !!}
                            {!! Form::file('posts_imagem') !!}
                            <br>
                            {!! Form::label('imagem','Adicionar Vídeo:') !!}
                            {!! Form::input('text', 'posts_video', null, ['class' => 'form-control', 'placeholder' => 'URL do Vídeo']) !!}
                            <br>
                            <br>
                            <hr>
                            <br>
                            {!! Form::label('nome','Título do Post:') !!}
                            {!! Form::input('text', 'posts_titulo', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Título']) !!}
                        </div>
                                                
                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('obs','Texto:') !!}
                            <br>
                            {!! Form::textarea('posts_texto', null, ['style' => 'width:100%', 'rows' => '5', 'class' => 'form-control', '', 'placeholder' => 'Digite aqui a Postagem']) !!}
                        </div>

                        <div class="form-group marginsV col-md-12">
                            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                        </div>
                            {!! Form::close() !!}
                    </div>        

                    <div class="panel-body">
                        <h4>Comentários desse Post</h4>
                        @if(isset($comments_editar_form))
                            @foreach($comments_editar_form as $comment)
                                <div class="form-group marginsV col-md-12">
                                    <p>Enviado em :{!! date_format($comment -> created_at, 'd/m/Y H:i' ) !!}</p>
                                    <p>Por :{!! $comment -> comments_nome !!}</p>
                                    <p>{!! $comment -> comments_texto !!}</p>
                                    <a href="{{ url('blog/'.$comment -> id.'/excluir_comments') }}" onclick="return confirm('Tem certeza que deseja excluir esse comentário?')">Excluir</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

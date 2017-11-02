@extends('layouts.gerenciadorLayout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Conteúdo do Site</h2>
                    <p>Atualizar uma área de cada vez</p>
                </div>

                <div class="panel-body">

                    @if (!empty($errors -> all()))
                        <div class="alert alert-danger">{{ $errors -> first() }}</div>
                    @elseif (Session::has('flashmsg'))
                        <div class="alert alert-success">{{ Session::get('flashmsg') }}</div>
                    @endif

                    <div class="form-group marginsV col-md-12 oneline-input">
                        
                        <div class="form-group marginsV col-md-12">

                            @if(empty($principals))

                                {!! Form::open(['url' => 'site/salvar_principal', 'method' => 'POST', 'files' => false, 'class' => 'form-inline']) !!} {{ csrf_field() }}
                            @else

                                {!! Form::model($principals, ['url' => 'site/principal/'.$principals -> id , 'method' => 'PATCH', 'files' => false, 'class' => 'form-inline']) !!}
                            @endif

                                {!! Form::label('nome','Título da página principal:') !!}
                                {!! Form::input('text', 'principal_titulo', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Título']) !!}

                                {!! Form::label('nome','Texto da página principal:') !!}
                                {!! Form::textarea('principal_texto', null, ['style' => 'width:100%', 'rows' => '5', 'class' => 'form-control', '', 'placeholder' => 'Digite aqui o Texto']) !!}

                                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}    
                            {!! Form::close() !!}

                        </div>

                        <div class="form-group marginsV col-md-12">

                            @if(empty($destaques))

                                {!! Form::open(['url' => 'site/salvar_destaque', 'method' => 'POST', 'files' => true, 'class' => 'form-inline']) !!} {{ csrf_field() }}
                            @else

                                {!! Form::model($destaques, ['url' => 'site/destaque/'.$destaques -> id , 'method' => 'PATCH', 'files' => true, 'class' => 'form-inline']) !!}
                            @endif

                            {!! Form::open(['url' => 'site/salvar_destaque', 'method' => 'POST', 'files' => true, 'class' => 'form-inline']) !!} {{ csrf_field() }}

                                {!! Form::label('nome','Título da página destaque:') !!}
                                {!! Form::input('text', 'destaque_titulo', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Título']) !!}

                                {!! Form::label('nome','Texto da página destaque:') !!}
                                {!! Form::textarea('destaque_texto', null, ['style' => 'width:100%', 'rows' => '5', 'class' => 'form-control', '', 'placeholder' => 'Digite aqui o Texto']) !!}

                                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}    
                            {!! Form::close() !!}
                        </div>

                        <div class="form-group marginsV col-md-12">

                            @if(empty($footers))

                                {!! Form::open(['url' => 'site/salvar_footer', 'method' => 'POST', 'files' => false, 'class' => 'form-inline']) !!} {{ csrf_field() }}
                            @else

                                {!! Form::model($footers, ['url' => 'site/footer/'.$footers -> id , 'method' => 'PATCH', 'files' => false, 'class' => 'form-inline']) !!}
                            @endif
                                
                                {!! Form::label('nome','Linha 1 do rodaṕé:') !!}
                                {!! Form::input('text', 'footer_linha1', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Linha 1']) !!}

                                {!! Form::label('nome','Linha 2 do rodaṕé:') !!}
                                {!! Form::input('text', 'footer_linha2', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Linha 2']) !!}

                                {!! Form::label('nome','Linha 3 do rodaṕé:') !!}
                                {!! Form::input('text', 'footer_linha3', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Linha 3']) !!}

                                {!! Form::label('nome','Linha 4 do rodaṕé:') !!}
                                {!! Form::input('text', 'footer_linha4', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Linha 4']) !!}

                                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}    
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

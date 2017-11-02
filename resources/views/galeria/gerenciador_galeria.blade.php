@extends('layouts.gerenciadorLayout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Galeria de Fotos</h2>
                </div>

                <div class="panel-body">

                    @if (!empty($errors -> all()))
                        <div class="alert alert-danger">{{ $errors -> first() }}</div>
                    @elseif (Session::has('flashmsg'))
                        <div class="alert alert-success">{{ Session::get('flashmsg') }}</div>
                    @endif

                    <div class="form-group marginsV col-md-12 oneline-input">
                        
                        <div class="form-group marginsV col-md-12">

                            {{-- @if(empty($galerias)) --}}

                                {!! Form::open(['url' => 'galeria/salvar_galeria', 'method' => 'POST', 'files' => true, 'class' => 'form-inline']) !!} {{ csrf_field() }}
                            {{-- @else --}}

                                {{-- {!! Form::model($galerias, ['url' => 'galeria/'.$galerias -> id , 'method' => 'PATCH', 'files' => true, 'class' => 'form-inline']) !!} --}}
                            {{-- @endif --}}

                                {!! Form::label('desc','Descrição da(s) Imagem(s):') !!}
                                {!! Form::textarea('galeria_descricao', null, ['style' => 'width:100%', 'rows' => '5', 'class' => 'form-control', '', 'placeholder' => 'Descrição']) !!}

                                {{-- {!! Form::textarea('text', 'galeria_descricao', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Descrição']) !!} --}}

                                {!! Form::label('img','Imagem(s):') !!}
                                {{ Form::file('galeria_imagem') }}

                                <br>
                                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}    
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">

            @foreach($galerias as $galeria)
                <div class="col-md-4">
                    <div class="thumbnail" style="margin:5px">

                            <a href="{{ $galeria->id }}/excluir_galeria" onclick="return confirm('Tem certeza que deseja excluir essa FOTO?')" value="excluir">Excluir</a>

                            <img class="" style="min-height:300px;" src="{{ asset('imagens/imagens_galeria/'.$galeria -> galeria_imagem) }}" alt="">
                            
                            <div class="caption">
                                <p style="font-size: 12px">{{$galeria -> galeria_descricao}}<p>
                            </div>

                    </div>
                </div>
            @endforeach
        
        </div>
</div>
@endsection

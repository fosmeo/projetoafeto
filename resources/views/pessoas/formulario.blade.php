@extends('layouts.gerenciadorLayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h2>CADASTRO DE PESSOAS</h2>
                    <a class="pull-right marginsH" href="{{ route('lista_pessoas') }}">Lista de Pessoas</a>
                    <br>
                </div>

                <div class="panel-body">
                    
                    @if (!empty($errors -> first()))
                        <div class="alert alert-danger">{{ $errors -> first() }}</div>
                    @endif

                    <!-- @if(Session::has('flashmsg'))
                        <div class="alert alert-success">{{ Session::get('flashmsg') }} {{ Session::get('msg_nome') }}</div>
                    @endif -->
                    
                    @if(Request::is('*/editar_pessoas'))

                        {!! Form::model($pessoa_editar_form, ['url' => 'pessoas/'.$pessoa_editar_form -> id , 'method' => 'PATCH', 'files' => true, 'class' => 'form-inline']) !!}

                        <div class="pull-left col-md-8">
                            <h3>Cadastro: {{ $pessoa_editar_form -> id }}</h3>
                            <br>
                            <h3>{{ $pessoa_editar_form -> pessoas_nome }}</h3>
                        </div>
                        
                        @if(empty($pessoa_editar_form -> pessoas_imagem))
                            <div class="pull-right col-md-4">
                                <p class="text-center" style="height:180px;border:3px solid #ccc;">Sem foto para exibir</p>
                            </div>
                        @else
                            <div class="text-center pull-right col-md-4">
                                <a href="excluir_foto_pessoas" onclick="return confirm('Tem certeza que deseja excluir essa FOTO?')">
                                    <img style="height:220px;width:210px;border:3px solid #ccc;" src="{{ asset('imagens/imagens_pessoas/'.$pessoa_editar_form -> pessoas_imagem)}}" >
                                </a>
                                <br>
                                <a href="excluir_foto_pessoas" onclick="return confirm('Tem certeza que deseja excluir essa FOTO?')">Remover Foto</a>
                            </div>
                        @endif

                    @else

                        {!! Form::open(['url' => 'pessoas/salvar_pessoas', 'method' => 'POST', 'files' => true, 'class' => 'form-inline']) !!}

                    @endif
                        
                        {{ csrf_field() }}

                        <div class="form-group marginsV col-md-12" style="border-bottom:1px solid #ccc; padding:20px">
                            <div class="">
                                {!! Form::label('imagem','Adicionar Foto:') !!}
                                {!! Form::file('pessoas_imagem') !!}
                            </div>
                            <div class="" style="padding-top: 30px">
                                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}    
                            </div>
                        </div>

                        <div class="form-group marginsV col-md-12 oneline-input" >
                            {!! Form::label('nome','Nome da Mãe:') !!}
                            {!! Form::input('text', 'pessoas_nome', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nome']) !!}
                        </div>

                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('data_nasc','Data de Nascimento:') !!}
                            {!! Form::input('text', 'pessoas_data_nasc', null, ['class' => 'form-control', '', 'placeholder' => 'Data de Nascimento']) !!}

                            {!! Form::label('idade','Idade:') !!}
                            {!! Form::input('text', 'pessoas_idade', null, ['class' => 'form-control', '', 'placeholder' => 'Idade']) !!}
                        </div>

                        <div class="form-group marginsV col-md-12 oneline-input">
                            {!! Form::label('endereco','Endereço') !!}
                            {!! Form::input('text', 'pessoas_endereco', null, ['class' => 'form-control', '', 'placeholder' => 'Endereço']) !!}
                        </div>

                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('tel1','Tel1:') !!}
                            {!! Form::input('text', 'pessoas_tel1', null, ['class' => 'form-control', '', 'placeholder' => 'Telefone 1']) !!}

                            {!! Form::label('tel2','Tel2:') !!}
                            {!! Form::input('text', 'pessoas_tel2', null, ['class' => 'form-control', '', 'placeholder' => 'Telefone 2']) !!}

                            {!! Form::label('tel3','Tel3:') !!}
                            {!! Form::input('text', 'pessoas_tel3', null, ['class' => 'form-control', '', 'placeholder' => 'Telefone 3']) !!}
                        </div>
                        
                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('sit_matrimonial','Situação Matrimonial:') !!}
                            <br>
                            {!! Form::label('sit_matrimonial1','Casada') !!}
                            {!! Form::radio('pessoas_sit_matrimonial', 'casada') !!}
                            <br>
                            {!! Form::label('sit_matrimonial2','Solteira') !!}
                            {!! Form::radio('pessoas_sit_matrimonial', 'solteira') !!}
                            <br>
                            {!! Form::label('sit_matrimonial3','Outro') !!}
                            {!! Form::radio('pessoas_sit_matrimonial', 'outro') !!} 
                        </div>

                        <div class="form-group marginsV col-md-12 oneline-input">
                            {!! Form::label('marido','Nome do Marido:') !!}
                            {!! Form::input('text', 'pessoas_marido', null, ['class' => 'form-control', '', 'placeholder' => 'Nome do Marido']) !!}
                        </div>

                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('filhos','Filhos:') !!}
                            {!! Form::textarea('pessoas_filhos', null, ['style' => 'width:100%', 'rows' => '4', 'class' => 'form-control', '', 'placeholder' => 'Filhos']) !!}
                        </div>

                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('local_trabalho','Local de Trabalho:') !!}
                            {!! Form::input('text', 'pessoas_local_trabalho', null, ['size' => 40, 'class' => 'form-control', '', 'placeholder' => 'Local de Trabalho']) !!}

                            {!! Form::label('local_trabalho','Tel.Trabalho:') !!}
                            {!! Form::input('text', 'pessoas_tel_local_trabalho', null, ['class' => 'form-control', '', 'placeholder' => 'Tel. Local de Trabalho']) !!}
                        </div>

                        <div class="form-group marginsV col-md-12">

                            {!! Form::label('data_parto','Data provável do Parto:') !!}
                            {!! Form::input('text', 'pessoas_data_parto', null, ['class' => 'form-control', '', 'placeholder' => 'Data provável de Parto']) !!}
                            <br><br>
                            {!! Form::label('tipo_parto','Tipo de Parto:') !!}                   
                            <br>
                            {!! Form::label('tipo_parto1','Normal') !!}
                            {!! Form::radio('pessoas_tipo_parto', 'normal') !!}
                            <br>
                            {!! Form::label('tipo_parto2','Cesárea') !!}
                            {!! Form::radio('pessoas_tipo_parto', 'cesarea') !!}

                        </div>

                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('data_assist','Data de Assistência:') !!}
                            {!! Form::input('text', 'pessoas_data_assist', null, ['class' => 'form-control', '', 'placeholder' => 'Data de Assistência']) !!}

                            {!! Form::label('acompanhante','Acomp.:') !!}
                            {!! Form::input('text', 'pessoas_acompanhante', null, ['size' => 40, 'class' => 'form-control', '', 'placeholder' => 'Acompanhante']) !!}
                        </div>
                        
                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('email','E-Mail:') !!}
                            {!! Form::input('email', 'pessoas_email', null, ['class' => 'form-control', '', 'placeholder' => 'E-Mail']) !!}
                        </div>
                        
                        <div class="form-group marginsV col-md-12">
                            {!! Form::label('obs','Observações Gerais:') !!}
                            <br>
                            {!! Form::textarea('pessoas_obs', null, ['style' => 'width:100%', 'rows' => '5', 'class' => 'form-control', '', 'placeholder' => 'Observações']) !!}
                        </div>

                        <div class="form-group marginsV col-md-12">
                            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}    
                        </div>

                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
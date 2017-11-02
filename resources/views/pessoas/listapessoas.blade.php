@extends('layouts.gerenciadorLayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h2>LISTA DE PESSOAS</h2>
                    <p>Total de cadastros :{{ $total }}</p>
                    <a class="pull-right marginsH" href="{{ route('formulario_pessoas') }}">Inserir Pessoa</a>
                    <br>
                </div>

                <div class="panel-body">
                    @if(Session::has('flashmsg'))
                        <div class="alert alert-success">
                            <h3>{{ Session::get('flashmsg') }} {{ Session::get('msg_nome') }}</h3>
                        </div>
                    @endif

                    {!! Form::open(['class' => 'form-inline', 'url' => 'pessoas/pesquisar_pessoas', 'method' => 'GET']) !!}
                    
                    {!! Form::label('buscar','Pesquisa:') !!}
                    {!! Form::input('text', 'pesquisa_nome', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nome']) !!}
                    
                    {!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}
                    <a class="btn btn-default" href="{{ route('lista_pessoas') }}">Ver Todas</a>
                    {!! Form::close()!!}
                    


                    <br>
                    <table class="table">
                        <th>ID</th>
                        <th>Data Cadastro</th>
                        <th>Nome</th>
                        <th>Ações</th>
                        <tbody>
                        @foreach($pessoas as $pessoa)
                            <tr>
                            
                                <td>{{ $pessoa -> id }}</td>
                                <td>{{ date_format($pessoa -> created_at, 'd/m/Y' ) }}</td>
                                <td>{{ $pessoa -> pessoas_nome }}</td>
                                <td>
                                    <a href="{{ $pessoa->id }}/editar_pessoas" class="btn btn-primary">Editar</a>
                                    
                                    {!! Form::open(['method' => 'DELETE' , 'url' => '../pessoas/'.$pessoa -> id, 'style' => 'display:inline', 'onsubmit' => 'return confirm("Tem certeza que deseja excluir?")']) !!}

                                        <button type="submit" href="{{ $pessoa->id }}/excluir" class="btn btn-danger" value="excluir">Excluir</button>

                                    {!!Form::close()!!}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    {{ $pessoas -> appends(Request::Input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.gerenciadorLayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h2> LISTA DE POSTS</h2>
                    <p>Total: {{ $total }}</p>
                    <a class="pull-right marginsH" href="{{ route('formulario_posts') }}">Criar Novo Post</a>
                    <a class="pull-right marginsH" href="{{ url('true/recalcular_comments') }}">Recalcular Comentários</a>
                    <br>
                </div>

                <div class="panel-body">
                    @if(Session::has('flashmsg'))
                        <div class="alert alert-success">
                            <h3>{{ Session::get('flashmsg') }}</h3>
                        </div>
                    @endif

                    {!! Form::open(['class' => 'form-inline', 'url' => 'blog/pesquisar_posts', 'method' => 'GET']) !!}
                    
                    {!! Form::label('buscar','Pesquisa:') !!}
                    {!! Form::input('text', 'pesquisa_post', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nome']) !!}

                    {!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}
                    <a class="btn btn-default" href="{{ route('lista_posts') }}">Ver Tudo</a>
                    
                    {!! Form::close()!!}

                    <br>
                    <table class="table">
                        <th>ID</th>
                        <th>Data Post</th>
                        <th>Título</th>
                        <th>Ações</th>
                        <tbody>

                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post -> id }}</td>
                                    <td>{{ date_format($post -> created_at, 'd/m/Y' ) }}</td>

                                    <td>{{ $post -> posts_titulo .'('. $post -> posts_total_comments .')'}} </td>
                                    
                                    <td>
                                        <a href="{{ $post->id }}/editar_posts" class="btn btn-primary">Editar</a>
                                        
                                        {!! Form::open(['method' => 'DELETE' , 'url' => 'blog/'.$post -> id, 'style' => 'display:inline', 'onsubmit' => 'return confirm("Tem certeza que deseja excluir?")']) !!}

                                            <button type="submit" class="btn btn-danger" value="excluir">Excluir</button>

                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $posts -> appends(Request::Input())->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
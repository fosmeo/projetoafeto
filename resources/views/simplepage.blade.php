@extends('layouts.singleLayout')

@section('content')

    <div class="container">

        <div class="row shadow-banner">
            <a href="{{url('/')}}"><img src="/imagens/banner_full.jpg"></a>
        </div>

        <div class="col-md-12">

            <div class="row">

                @foreach($posts as $post)

                <div class="col-md-12 padding-posts">
                    <div class="col-md-12 post-top">
                        <table>
                            <tr>
                                <td class="post-data">
                                    {!! date_format($post -> created_at, 'd') !!}
                                    <br>
                                    {!! date_format($post -> created_at, 'M') !!}
                                    <br>
                                    {!! date_format($post -> created_at, 'Y') !!}
                                </td>
                                <td class="post-titulo">{{ $post -> posts_titulo }}</td>
                            </tr>
                        </table>
                    </div>

                    <div>
                        @if(!empty($post -> posts_imagem))
                            <div class="text-center col-md-12">
                                <img style="border:0px solid #ccc;" src="{{ asset('imagens/imagens_posts/'.$post -> posts_imagem)}}" >
                            </div>

                        @elseif(!empty($post -> posts_video))
                            <div class="text-center col-md-12 iframe-video">
                                {!! html_entity_decode($post -> posts_video) !!}
                            </div>

                        @endif

                        <div class="col-md-12 shadow-texts">
                            
                            <div>{!! nl2br($post -> posts_texto) !!}</div>
                            
                            <div class="panel-group" id="accordion">
                                <h4 class="panel-title" style="text-align:center; margin-top:50px;margin-bottom:20px">

                                    <?php
                                        $qtde_comments= 0;
                                        foreach ($comments as $comment) {
                                            if ($comment["posts_id"] == $post -> id){
                                                $qtde_comments++;
                                            }
                                        }
                                    ?>

                                    <a style="color:#337ab7;margin:20px 10px 0px 10px" data-toggle="collapse" data-parent="#accordion" href="#comment_show_{{$post -> id}}">Ver Comentários ({!! $qtde_comments !!})</a>

                                    <a style="color:#337ab7;margin:20px 10px 0px 10px" data-toggle="collapse" data-parent="#accordion" href="#comment_action_{{$post -> id}}">Comentar</a>

                                    <br>

                                </h4>

                                <div id="comment_action_{{$post -> id}}" class="panel-collapse collapse">

                                    <div class="panel-body">
                                        {!! Form::open(['url' => '/'. $post->id, 'method' => 'POST', 'files' => false, 'class' => 'form-horizontal']) !!}
                                            {{ csrf_field() }}
                                            {!! Form::hidden('posts_id', $post -> id) !!}
                                            {!! Form::input('text', 'comments_nome', null, ['class' => 'form-control', 'placeholder' => 'Seu nome']) !!}
                                            {!! Form::textarea('comments_texto', null, ['style' => 'width:100%', 'rows' => '5', 'class' => 'form-control', '', 'placeholder' => 'Digite aqui o comentário']) !!}
                                            <br>
                                            {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                                <div id="comment_show_{{$post -> id}}" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="col-md-12 padding-posts">
                                        @foreach($comments as $comment)
                                            @if($comment -> posts_id == $post -> id)
                                                <div class="area-comments">
                                                    <p>Enviado em: {{ date_format($comment -> created_at, 'd/m/Y - H:i') }}h
                                                    <p>Por: {{ $comment -> comments_nome }}</p>
                                                    </p>
                                                    <h5>{{ $comment -> comments_texto }}</h5>
                                                </div>
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach                
            </div>
        </div>


    </div>

    <div style="text-align: center;padding:30px 0px 30px 0px"">
        <a style="color:#337ab7;" href="{{ url('/') }}">Voltar para a Página Inicial</a>
    </div>

    @section('footer')
        @foreach($footers as $footer)
            @if(!empty($footer -> footer_linha1))
                {{ $footer -> footer_linha1 }}<br>
            @endif
            @if(!empty($footer -> footer_linha2))
                {{ $footer -> footer_linha2 }}<br>
            @endif
            @if(!empty($footer -> footer_linha3))
                {{ $footer -> footer_linha3 }}<br>
            @endif
            @if(!empty($footer -> footer_linha4))
                {{ $footer -> footer_linha4 }}
            @endif
        @endforeach
    @stop

    <!-- MODAL MENSAGENS     -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">                
                
                <div class="modal-body"> 

                    <div style="float:left">
                        <img src="imagens/logo-peq.jpg">
                    </div>
                    
                    @if(!empty($errors -> all()))
                        <div style="float:left;padding:10px">
                            <h3>{{ $errors -> first() }}</h3>
                        </div>                        
                    @elseif(Session::has('flashmsg'))                    
                        <div style="float:left;padding:10px">
                            <h3>{{ Session::get('flashmsg') }}</h3>
                        </div>
                    @endif
                </div>

                <div class="modal-footer" style="clear: both">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
    </div>

<script type="text/javascript">
     $(document).ready(function(){
        @if (!empty($errors -> all()) || Session::has('flashmsg'))
            $("#myModal").modal('show');
        @endif        
    });
</script>

@stop
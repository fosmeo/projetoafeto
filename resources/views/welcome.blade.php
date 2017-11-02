@extends('layouts.appLayout')

@section('content')

    <div class="container">

        <div class="row shadow-banner">
            <img src="imagens/banner_full.jpg">
        </div>

        @foreach($principals as $principal)
            @if(!empty($principal -> principal_titulo))
                <div id="intro">
                    <div class="principal-borda">
                        <h4><strong>{{$principal -> principal_titulo }}</strong></h4>
                        <strong class="text-center">{!! nl2br($principal -> principal_texto) !!}</strong>
                        <br>
                        <a href="{{ url('post/main') }}"><u>Saiba Mais</u></a>
                    </div>
                </div>
            @endif
        @endforeach

        <div class="col-md-9">

            <div class="row">

                @foreach($posts as $post)

                <div class="col-md-12 padding-posts">
                    <div class="col-md-12 post-top">
                        <table>
                            <tr>
                                <td class="post-data">
                                    <span>{{ date_format($post -> created_at, 'd') }}</span>
                                    
                                    <span>{{ date_format($post -> created_at, 'M') }}</span>
                                    
                                    {{ date_format($post -> created_at, 'Y') }}
                                </td>
                                <td class="post-titulo"><a href="{{ url('post/'.$post -> id) }}">{{ $post -> posts_titulo }}</a></td>
                            </tr>
                        </table>
                    </div>

                    <div>
                        @if(!empty($post -> posts_imagem))
                            <div class="text-center col-md-12">
                                <img style="border:0px solid #ccc;" src="{{ asset('imagens/imagens_posts/'.$post -> posts_imagem) }}" >
                            </div>

                        @elseif(!empty($post -> posts_video))
                            <div class="text-center col-md-12 iframe-video">
                                {!! html_entity_decode($post -> posts_video) !!}
                            </div>

                        @endif

                        <div class="col-md-12 shadow-texts area-posts-texto">
                            
                            <p>{!! nl2br($post -> posts_texto) !!}</p>
                            
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

                                    <a style="color:#337ab7;margin:20px 10px 0px 10px" data-toggle="collapse" data-parent="#accordion" href="#comment_show_{{$post -> id}}">Ver Comentários ({{ $qtde_comments }})</a>

                                    <a style="color:#337ab7;margin:20px 10px 0px 10px" data-toggle="collapse" data-parent="#accordion" href="#comment_action_{{$post -> id}}">Comentar</a>

                                    <br>

                                </h4>

                                <div id="comment_action_{{$post -> id}}" class="panel-collapse collapse">

                                    <div class="panel-body">
                                        {!! Form::open(['url' => '/'. $post->id, 'method' => 'POST', 'files' => false, 'class' => 'form-horizontal']) !!}
                                            {{ csrf_field() }}
                                            {!! Form::hidden('posts_id', $post -> id) !!}
                                            {!! Form::input('text', 'comments_nome', null, ['class' => 'form-control', 'placeholder' => 'Seu nome']) !!}
                                            {!! Form::textarea('comments_texto', null, ['style' => 'width:100%;', 'rows' => '5', 'class' => 'form-control', '', 'placeholder' => 'Digite aqui o comentário']) !!}
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

        <div class="col-md-3">
            <div class="row">
                <div class="margin-rows shadow-texts">
                    <strong>Leia os Posts Mais Comentados</strong>
                    <br><br>
                    <ul>
                        @foreach($maiscomentados as $maiscomentado)
                            <a href="{{url('post/'.$maiscomentado -> posts_id)}}">{{ $maiscomentado -> posts_titulo . '(' . $maiscomentado -> contador .')'}}</a><br><br>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div style="text-align: center">
        {{ $posts -> links() }}
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
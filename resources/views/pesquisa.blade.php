@extends('layouts.appLayout')

@section('content')

    <div class="container">

        <div class="row shadow-banner">
            <a href="{{url('/')}}"><img src="/imagens/banner_full.jpg"></a>
        </div>
        
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12 padding-posts">
                    <div id="destaque">
                        <h3><strong>Resultados da Pesquisa</strong></h3>
                        <br>
                        @foreach($posts as $post)
                            <p>{{ date_format($post -> created_at, 'd/m/Y') }} - <a href="{{ url('post/'.$post -> id) }}">{{ $post -> posts_titulo }}</a></p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="text-align: center">
        {{ $posts -> appends(Request::Input())->links() }}
    </div>

    <div style="text-align: center;padding:30px 0px 30px 0px">
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


<script type="text/javascript">
     $(document).ready(function(){
        @if (!empty($errors -> all()) || Session::has('flashmsg'))
            $("#myModal").modal('show');
        @endif        
    });
</script>

@stop
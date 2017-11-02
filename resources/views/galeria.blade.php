@extends('layouts.appLayout')

@section('content')

    <div class="container">

        <div class="row shadow-banner">
            <a href="{{url('/')}}"><img src="/imagens/banner_full.jpg"></a>
        </div>

        <div class="col-md-12 padding-posts">
            <div class="row">
                <div class="col-md-12" id="destaque">
                    
                    <h4 class="text-center"><strong>Galeria de Fotos</strong></h4>
                    <br>

                    @foreach($galerias as $galeria)
                        <div class="col-md-4">
                            <div class="thumbnail" style="margin:5px">
                                    <img class="" style="min-height:300px;" src="{{ 'imagens/imagens_galeria/'.$galeria -> galeria_imagem }}" alt="">
                                    <div class="caption">
                                        <p class="galeria-descricao">{{$galeria -> galeria_descricao}}</p>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div style="text-align: center">
        {{ $galerias -> links() }}
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


<script type="text/javascript">
     $(document).ready(function(){
        @if (!empty($errors -> all()) || Session::has('flashmsg'))
            $("#myModal").modal('show');
        @endif        
    });
</script>

@stop
@extends('layout')

@section('cabecalho')
Minhas séries favoritas
@endsection

@section('conteudo')


<a href="{{ route('listar_series') }}" class="btn btn-dark mb-2">Todas as séries</a>

<ul class="list-group">
    @csrf
    @foreach($series as $serie)
    <li id="serie-{{ $serie->id }}" class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <img src="http://localhost:8000/storage/{{ $serie->capa }}" class="img-thumbnail" height="100px" width="100px">
            <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}
            </span>
        </div>  

        <span class="d-flex" >  
            @csrf
            @auth
            <button class="btn btn-info btn-sm mr-1" onclick="desfavoritaSerie(({{ $serie->id }}))">
                <span>Desfavoritar</span>
            </button>
            @endauth   
          
        </span>
          
    </li>
    @endforeach
</ul>
<script>
    function desfavoritaSerie(serieId){
        let formData = new FormData();
       const token = document
            .querySelector('input[name="_token"]')
            .value;
        formData.append('_token', token);

        const url = `/series/${serieId}/desfavoritaSerie`;
        fetch(url, {
            method: 'POST',
            body: formData,
        }).then(() => {
            tirarSerie(serieId);
        });
    }
    function tirarSerie(serieId) {
        alert(serieId);
        const serie = document.getElementById(`serie-${serieId}`);
        serie.style.display = "none";
    }
</script>
@endsection
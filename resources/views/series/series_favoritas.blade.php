@extends('layout')

@section('cabecalho')
Minhas séries favoritas
@endsection

@section('conteudo')


<a href="{{ route('listar_series') }}" class="btn btn-dark mb-2">Todas as séries</a>

<ul class="list-group">
  
    @foreach($series as $serie)
    @csrf
    <li id="serie-{{ $serie->id }}" class="list-group-item" > 
        <div class="d-flex justify-content-between align-items-center">
            <span>
                <img src="http://localhost:8000/storage/{{ $serie->capa }}" class="img-thumbnail" height="100px" width="100px">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}
                </span>
            </span>  

            <span >  
            
                <button title="Desfavoritar"  id="desfavorita-{{ $serie->id }}" class="btn btn-danger btn-sm mr-1" onclick="desfavoritaSerie(({{ $serie->id }}))">
                    <i class="fas fa-heart" ></i>
                </button> 
            
            </span>
        </div> 
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
        const serie = document.getElementById(`serie-${serieId}`);
        serie.hidden = true;
    }
</script>
@endsection
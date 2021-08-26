@extends('layout')
@section('cabecalho')
    Adicionar Série
@endsection
@section('conteudo')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col col-5">
            <label for="nome" class="">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>
        <div class="col col-2">
            <label for="qtd_temporadas" class="">Nº temporadas</label>
            <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas">
        </div>
        <div class="col col-2">
            <label for="ep_por_temporada" class="">Ep. por Temporada</label>
            <input type="number" class="form-control" name="ep_por_temporada" id="ep_por_temporada">
        </div> 
        <div class="col col-3">
            <label for="categoria_id" class="">Categoria</label>
                <select id="categoria_id" name="categoria_id">  
                  @foreach($categorias as $categoria)
                      <option value={{ $categoria->id }}>{{ $categoria->nome }}</option>
                  @endforeach
                </select>           
        </div>   
    </div>    
    <div class="row">
        <div class="col col-3">
            <label for="nome" class="">Capa</label>
            <input type="file" class="form-control" name="capa" id="capa">
        </div>
    </div>
    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection
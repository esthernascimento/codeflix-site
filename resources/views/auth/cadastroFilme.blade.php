@extends('template')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cadastroFilme.css') }}">
<form method="POST" action="{{ route('filmes.store') }}">
    @csrf

    <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>

    <div>
        <label for="genero">Gênero:</label>
        <input type="text" id="genero" name="genero" required>
    </div>

    <div>
        <label for="imagem">URL da Imagem:</label>
        <input type="url" id="imagem" name="imagem">
    </div>

    <div>
        <label for="classificacao">Classificação Indicativa (0 a 18):</label>
        <input type="number" id="classificacao" name="classificacao" required min="0" max="18">
    </div>

    <button type="submit">Cadastrar Filme</button>
</form>


@endsection
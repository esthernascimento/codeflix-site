@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Editar Membro</h1>

    <form action="{{ route('membros.update', $membro) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nome:</label>
        <input type="text" name="nome" value="{{ $membro->nome }}" required>

        <label>Usuário Instagram:</label>
        <input type="text" name="usuario_instagram" value="{{ $membro->usuario_instagram }}">

        <label>Imagem:</label>
        <input type="file" name="imagem">
        @if($membro->imagem)
            <img src="{{ asset('storage/' . $membro->imagem) }}" alt="Imagem atual">
        @endif

        <button type="submit">Atualizar</button>
    </form>
</div>
@endsection

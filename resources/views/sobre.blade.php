<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quem Somos - Codeflix</title>
    <link rel="stylesheet" href="{{ asset('css/sobre.css') }}">
</head>
<body>

   <header>
    <div class="interface">
        <div class="logo">
            <a href="{{ url('/') }}">  <img src="{{ asset('img/codeflix-white.png') }}" alt="Logo Codeflix"> </a>
        </div>

        <nav class="menu-desktop">
            <ul>
                <li><a href="{{ url('/') }}">HOME</a></li>
                <li><a href="#">EM CARTAZ</a></li>
                <li><a href="{{ url('/contato') }}">CONTATO</a></li>
                <li><a href="{{ url('/sobre') }}">QUEM SOMOS</a></li>
            </ul>
        </nav>

        <div class="btn-contato">
            <a href="#"> <button>MINHA CONTA</button>
            </a>
        </div>
    </div>
</header>
@if(session('success'))
    <div style="background-color: #28a745; color: white; text-align: center; padding: 15px;">
        {{ session('success') }}
    </div>
@endif
    <div class="main-container">
        <div class="content">
            <h1 class="titulo">Quem Somos?</h1>
            <div class="team-cards">
                @forelse ($membros as $membro)
                    <div class="member-card">
                       <img src="{{ asset('img/' . $membro->imagem) }}" alt="{{ $membro->nome }}" class="member-image">
                        <div class="member-card-inner">
                             <div class="member-name">{{ $membro->nome }}</div>
<div class="member-social">{{ $membro->usuario_instagram }}</div>

<div class="admin-actions">
    
    <a href="{{ route('membros.edit', $membro->id) }}" class="btn-edit">
        Editar
    </a>

    <form action="{{ route('membros.destroy', $membro->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este membro?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">
            Excluir
        </button>
    </form>
</div>
                        </div>
                    </div>
                @empty
                    <p style="font-size: 1.2rem;">Nenhum membro da equipe foi adicionado ainda.</p>
                @endforelse
            </div>
        </div>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeFlix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}"> {{-- Essencial para o layout --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>

    <header>
    
        <div class="interface">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/codeflix-white.png') }}" class="logo" alt="Logo Codeflix">
                </a>
            </div>
            <nav class="menu-desktop">
                <ul>
                    <li><a href="{{ url('/') }}">HOME</a></li>
                    <li><a href="#">EM CARTAZ</a></li>
                    <li>
                        @if(auth()->check() && auth()->user()->is_admin)
                            <a href="{{ route('dashboard') }}">CONTATO</a>
                        @else
                            <a href="{{ url('/contato') }}">CONTATO</a>
                        @endif
                    </li>
                    <li><a href="{{ url('/sobre') }}">QUEM SOMOS</a></li>
                </ul>
            </nav>
            <div class="btn-contato">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">SAIR</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        <button>MINHA CONTA</button>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <div class="main-container">
        
        @yield('sidebar')

        <main class="content-wrapper">
            @yield('content')
        </main>

    </div>

    <footer>
        <p>Codeflix todos os direitos reservados &copy;</p>
    </footer>
</body>
</html>
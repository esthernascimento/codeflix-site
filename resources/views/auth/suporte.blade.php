@extends('template')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="dashboard">
    <!-- Menu lateral -->
    <aside class="sidebar">
        <ul>
            <li><a href="#"><i class="bi bi-house-door-fill"></i></a></li>
            <li><a href="{{ url('/suporte.blade.php') }}"><i class="bi bi-people-fill"></i></a></li>
            <li><a href="#"><i class="bi bi-question-circle-fill"></i></a></li>
            <li><a href="#"><i class="bi bi-lock-fill"></i></a></li>
            <li><a href="{{ route('logout') }}">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="bi bi-box-arrow-right"></i></button>
                </form>
            </a></li>
        </ul>
    </aside>

    <main class="content">
        <div class="cards">
            <div class="card">
                <i class="bi bi-person-fill"></i>
                <p>Adm cadastrados</p>
                <h2>4</h2>
            </div>

            <div class="card">
                <i class="bi bi-film"></i>
                <p>Filmes em Cartaz</p>
                <h2>10</h2>
            </div>

            <div class="card">
                <i class="bi bi-people"></i>
                <p>Usuários Cadastrados</p>
                <h2>101</h2>
            </div>
        </div>
    </main>
</div>
@endsection
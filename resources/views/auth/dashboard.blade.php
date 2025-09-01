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
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Sair" style="background:none;border:none;cursor:pointer;">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Conteúdo principal -->
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

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="box-table">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Nome Contato</th>
                        <th>E-mail</th>
                        <th>Mensagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($contatos)
                        @forelse($contatos as $item)
                            <tr>
                                <td>{{ $item->nome }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mensagem }}</td>
                                <td class="actions">
                                    
                                    <a href="#" title="Editar"><i class="bi bi-pencil"></i></a>
                                    <a href="#" title="Desativar"><i class="bi bi-slash-circle"></i></a>
                                    <a href="#" title="Excluir"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;">Nenhum contato encontrado.</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="4" style="text-align:center;">Lista de contatos não carregada.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>

            @isset($contatos)
                @if(method_exists($contatos, 'links'))
                    <div class="pagination">
                        {{ $contatos->links() }}
                    </div>
                @endif
            @endisset
        </div>
    </main>
</div>
@endsection

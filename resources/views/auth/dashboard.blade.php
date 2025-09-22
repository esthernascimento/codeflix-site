@extends('template')

@section('sidebar')
    @include('sidebar')
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

<div class="cards">
    <div class="card">
        <i class="bi bi-person-fill"></i>
        <p>Adm cadastrados</p>
        <h2>{{ $adminsCount ?? 4 }}</h2>
    </div>

    <div class="card">
        <i class="bi bi-film"></i>
        <p>Filmes em Cartaz</p>
        <h2>{{ $filmesCount ?? 10 }}</h2>
    </div>

    <div class="card">
        <i class="bi bi-people"></i>
        <p>Membros Cadastrados</p>
        <h2>{{ $membrosCount ?? 101 }}</h2>
    </div>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

{{-- =========================================
    TABELA DE CONTATOS (mantida)
========================================= --}}
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

{{-- =========================================
    FILMES POR GÊNERO (contagens fixas)
========================================= --}}
<div class="box-table" style="margin-top: 24px;">
    <table class="table-custom">
        <thead>
            <tr>
                <th>Gênero</th>
                <th>Total de filmes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Comédia</td>
                <td>{{ $totalComedia ?? 0 }}</td>
            </tr>
            <tr>
                <td>Ação</td>
                <td>{{ $totalAcao ?? 0 }}</td>
            </tr>
            <tr>
                <td>Drama</td>
                <td>{{ $totalDrama ?? 0 }}</td>
            </tr>
            <tr>
                <td>Animação</td>
                <td>{{ $totalAnimacao ?? 0 }}</td>
            </tr>
        </tbody>
    </table>
</div>

{{-- =========================================
    Listas de títulos por gênero (opcional)
========================================= --}}
<div class="box-table" style="margin-top: 24px;">
    <h3 style="margin: 12px 0;">Comédia ({{ $totalComedia ?? 0 }})</h3>
    <ul>
        @forelse(($filmesComedia ?? collect()) as $f)
            <li>{{ $f->titulo }}</li>
        @empty
            <li>Nenhum filme de Comédia.</li>
        @endforelse
    </ul>

    <h3 style="margin: 12px 0;">Ação ({{ $totalAcao ?? 0 }})</h3>
    <ul>
        @forelse(($filmesAcao ?? collect()) as $f)
            <li>{{ $f->titulo }}</li>
        @empty
            <li>Nenhum filme de Ação.</li>
        @endforelse
    </ul>

    <h3 style="margin: 12px 0;">Drama ({{ $totalDrama ?? 0 }})</h3>
    <ul>
        @forelse(($filmesDrama ?? collect()) as $f)
            <li>{{ $f->titulo }}</li>
        @empty
            <li>Nenhum filme de Drama.</li>
        @endforelse
    </ul>

    <h3 style="margin: 12px 0;">Animação ({{ $totalAnimacao ?? 0 }})</h3>
    <ul>
        @forelse(($filmesAnimacao ?? collect()) as $f)
            <li>{{ $f->titulo }}</li>
        @empty
            <li>Nenhum filme de Animação.</li>
        @endforelse
    </ul>
</div>

</main>
</div>
@endsection

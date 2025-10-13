@extends('template')

@section('sidebar')
    @include('sidebar')
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<main class="dashboard-content">
    <div class="top-cards">
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

    <div class="charts-row">
        <div class="chart-box">
            <div id="filmesChart" class="chart"></div>
        </div>
        <div class="chart-box">
            <div id="classificacaoChart" class="chart"></div>
        </div>
    </div>

    <div class="downloads">
        <a href="/download-contatos-csv" class="btn-download">
            <i class="bi bi-download"></i> Baixar Contatos CSV
        </a>
        <a href="/download-filmes-csv" class="btn-download">
            <i class="bi bi-download"></i> Baixar Filmes CSV
        </a>
    </div>

    <div class="tables-row">
        <div class="box-table">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th class="sortable">
                            @php $nextDirection = ($sort == 'nome' && $direction == 'asc') ? 'desc' : 'asc'; @endphp
                            <a href="{{ url()->current() }}?sort=nome&direction={{ $nextDirection }}">
                                Nome Contato
                                @if($sort == 'nome')
                                    <i class="bi {{ $direction == 'asc' ? 'bi-sort-alpha-down' : 'bi-sort-alpha-up' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>E-mail</th>
                        <th>Mensagem</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contatos as $item)
                        <tr>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mensagem }}</td>
                            <td>
                                @if($item->caminho_foto)
                                <img src="{{ asset('storage/' . $item->caminho_foto) }}" alt="Foto de {{ $item->nome }}" class="contact-photo">
                                @else
                                    <span>Não encaminhou foto</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align:center;">Nenhum contato encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
            @isset($contatos)
                @if(method_exists($contatos, 'links'))
                    <div class="pagination">{{ $contatos->appends(request()->query())->links() }}</div>
                @endif
            @endisset
        </div>

        <div class="box-table">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Gênero</th>
                        <th class="sortable">
                            @php $nextDirection = ($sort == 'total' && $direction == 'desc') ? 'asc' : 'desc'; @endphp
                            <a href="{{ url()->current() }}?sort=total&direction={{ $nextDirection }}">
                                Total de filmes
                                @if($sort == 'total')
                                    <i class="bi {{ $direction == 'asc' ? 'bi-sort-numeric-down' : 'bi-sort-numeric-up-alt' }}"></i>
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($generos as $genero)
                        <tr>
                            <td>{{ $genero['nome'] }}</td>
                            <td>{{ $genero['total'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    var filmesGenero = {
        'Comédia': {{ $totalComedia ?? 0 }},
        'Ação': {{ $totalAcao ?? 0 }},
        'Drama': {{ $totalDrama ?? 0 }},
        'Animação': {{ $totalAnimacao ?? 0 }}
    };

    var filmesChart = echarts.init(document.getElementById('filmesChart'));
    filmesChart.setOption({
        title: { text: 'Filmes Cadastrados por Gênero', left: 'center', textStyle: { color: '#fff' } },
        tooltip: { trigger: 'item' },
        legend: { bottom: 0, textStyle: { color: '#fff' } },
        color: ['#E50914', '#69fcfcff', '#00f84aff', '#af634cff'],
        series: [{
            type: 'pie',
            radius: ['40%', '70%'],
            data: Object.entries(filmesGenero).map(([g, t]) => ({ name: g, value: t }))
        }]
    });

    var filmesClassificacao = {
        'Livre': {{ $totalL ?? 0 }},
        '10 anos': {{ $total10 ?? 0 }},
        '12 anos': {{ $total12 ?? 0 }},
        '16 anos': {{ $total16 ?? 0 }}
    };
    
    var classificacaoChart = echarts.init(document.getElementById('classificacaoChart'));
    classificacaoChart.setOption({
        title: {
            text: 'Filmes por Classificação Etária',
            left: 'center',
            textStyle: { color: '#fff' }
        },
        tooltip: { trigger: 'axis' },
        xAxis: {
            type: 'category',
            data: Object.keys(filmesClassificacao),
            axisLabel: { color: '#fff' }
        },
        yAxis: {
            type: 'value',
            axisLabel: { color: '#fff' }
        },
        series: [{
            type: 'bar',
            data: Object.entries(filmesClassificacao).map(([key, value], index) => ({
                value: value,
                itemStyle: {
                    color: ['#00a86b', '#69fcfcff', '#ffd700', '#ff0000'][index],
                    borderRadius: [6, 6, 0, 0]
                }
            }))
        }]
    });
</script>
@endsection
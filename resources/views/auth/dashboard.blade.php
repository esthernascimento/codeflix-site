@extends('template')

@section('sidebar')
    @include('sidebar')
@endsection

@section('content')
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <main>
        {{-- CARDS --}}
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

        {{-- ALERTA --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="charts-container">
            <div id="filmesChart" style="width: 100%; height: 400px; margin-top: 24px;"></div>
            <div id="classificacaoChart" style="width: 100%; height: 400px; margin-top: 24px;"></div>
        </div>
       
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

        <div class="box-table" style="margin-top: 24px;">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Gênero</th>
                        <th>Total de filmes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Comédia</td><td>{{ $totalComedia ?? 0 }}</td></tr>
                    <tr><td>Ação</td><td>{{ $totalAcao ?? 0 }}</td></tr>
                    <tr><td>Drama</td><td>{{ $totalDrama ?? 0 }}</td></tr>
                    <tr><td>Animação</td><td>{{ $totalAnimacao ?? 0 }}</td></tr>
                </tbody>
            </table>
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
        var optionFilmes = {
            title: {
                text: 'Filmes Cadastrados por Gênero',
                left: 'center',
                top: 10,
                textStyle: { color: '#fff', fontSize: 16, fontWeight: 'bold' }
            },
            tooltip: { trigger: 'item', formatter: '{b}: {c} ({d}%)' },
            legend: { orient: 'horizontal', bottom: 0, textStyle: { color: '#fff', fontSize: 12 } },
            color: ['#ff6b6b', '#F80000', '#595959', '#7f1d1d', '#d4d4d4'],
            series: [{
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: { show: false, position: 'center' },
                emphasis: { label: { show: true, fontSize: 18, fontWeight: 'bold', color: '#fff' } },
                labelLine: { show: false },
                data: Object.entries(filmesGenero).map(([genero, total]) => ({ name: genero, value: total }))
            }]
        };
        filmesChart.setOption(optionFilmes);

        var filmesClassificacao = {
            'Livre': {{ $totalL ?? 0 }},
            '10 anos': {{ $total10 ?? 0 }},
            '12 anos': {{ $total12 ?? 0 }},
            '16 anos': {{ $total16 ?? 0 }}
        };

        var classificacaoChart = echarts.init(document.getElementById('classificacaoChart'));
        var optionClassificacao = {
            title: {
                text: 'Filmes por Classificação Etária',
                left: 'center',
                top: 10,
                textStyle: { color: '#fff', fontSize: 16, fontWeight: 'bold' }
            },
            tooltip: { trigger: 'axis' },
            xAxis: { type: 'category', data: Object.keys(filmesClassificacao), axisLabel: { color: '#fff' } },
            yAxis: { type: 'value', axisLabel: { color: '#fff' } },
            series: [{
                data: Object.values(filmesClassificacao),
                type: 'bar',
                itemStyle: {
                    color: function (params) {
                        const colors = ['#00ff00', '#ffff00', '#ff8c00', '#ff0000'];
                        return colors[params.dataIndex];
                    },
                    borderRadius: [6, 6, 0, 0]
                }
            }]
        };
        classificacaoChart.setOption(optionClassificacao);
    </script>
@endsection
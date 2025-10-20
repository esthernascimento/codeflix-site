<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/layout.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<main class="dashboard-content">
    <div class="top-cards">
        <div class="card">
            <i class="bi bi-person-fill"></i>
            <p>Adm cadastrados</p>
            <h2><?php echo e($adminsCount ?? 4); ?></h2>
        </div>
        <div class="card">
            <i class="bi bi-film"></i>
            <p>Filmes em Cartaz</p>
            <h2><?php echo e($filmesCount ?? 10); ?></h2>
        </div>
        <div class="card">
            <i class="bi bi-people"></i>
            <p>Membros Cadastrados</p>
            <h2><?php echo e($membrosCount ?? 101); ?></h2>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

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
                            <?php $nextDirection = ($sort == 'nome' && $direction == 'asc') ? 'desc' : 'asc'; ?>
                            <a href="<?php echo e(url()->current()); ?>?sort=nome&direction=<?php echo e($nextDirection); ?>">
                                Nome Contato
                                <?php if($sort == 'nome'): ?>
                                    <i class="bi <?php echo e($direction == 'asc' ? 'bi-sort-alpha-down' : 'bi-sort-alpha-up'); ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>E-mail</th>
                        <th>Mensagem</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $contatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($item->nome); ?></td>
                            <td><?php echo e($item->email); ?></td>
                            <td><?php echo e($item->mensagem); ?></td>
                            <td>
                                <?php if($item->caminho_foto): ?>
                                <img src="<?php echo e(asset('storage/' . $item->caminho_foto)); ?>" alt="Foto de <?php echo e($item->nome); ?>" class="contact-photo">
                                <?php else: ?>
                                    <span>Não encaminhou foto</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" style="text-align:center;">Nenhum contato encontrado.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if(isset($contatos)): ?>
                <?php if(method_exists($contatos, 'links')): ?>
                    <div class="pagination"><?php echo e($contatos->appends(request()->query())->links()); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="box-table">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Gênero</th>
                        <th class="sortable">
                            <?php $nextDirection = ($sort == 'total' && $direction == 'desc') ? 'asc' : 'desc'; ?>
                            <a href="<?php echo e(url()->current()); ?>?sort=total&direction=<?php echo e($nextDirection); ?>">
                                Total de filmes
                                <?php if($sort == 'total'): ?>
                                    <i class="bi <?php echo e($direction == 'asc' ? 'bi-sort-numeric-down' : 'bi-sort-numeric-up-alt'); ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $generos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($genero['nome']); ?></td>
                            <td><?php echo e($genero['total']); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <a href="/download-pdf" class="btn-pdf">Gerar PDF</a>
        </div>
        
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    var filmesGenero = {
        'Comédia': <?php echo e($totalComedia ?? 0); ?>,
        'Ação': <?php echo e($totalAcao ?? 0); ?>,
        'Drama': <?php echo e($totalDrama ?? 0); ?>,
        'Animação': <?php echo e($totalAnimacao ?? 0); ?>

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
        'Livre': <?php echo e($totalL ?? 0); ?>,
        '10 anos': <?php echo e($total10 ?? 0); ?>,
        '12 anos': <?php echo e($total12 ?? 0); ?>,
        '16 anos': <?php echo e($total16 ?? 0); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gisel\Desktop\DS-Etec\3-MODULO\PW3\codeflix-site\resources\views/auth/dashboard.blade.php ENDPATH**/ ?>
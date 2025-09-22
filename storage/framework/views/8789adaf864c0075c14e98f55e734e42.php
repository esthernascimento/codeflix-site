<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">

<div class="cards">
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
            <?php if(isset($contatos)): ?>
                <?php $__empty_1 = true; $__currentLoopData = $contatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->nome); ?></td>
                        <td><?php echo e($item->email); ?></td>
                        <td><?php echo e($item->mensagem); ?></td>
                        <td class="actions">
                            <a href="#" title="Editar"><i class="bi bi-pencil"></i></a>
                            <a href="#" title="Desativar"><i class="bi bi-slash-circle"></i></a>
                            <a href="#" title="Excluir"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">Nenhum contato encontrado.</td>
                    </tr>
                <?php endif; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Lista de contatos não carregada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if(isset($contatos)): ?>
        <?php if(method_exists($contatos, 'links')): ?>
            <div class="pagination">
                <?php echo e($contatos->links()); ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>
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
            <tr>
                <td>Comédia</td>
                <td><?php echo e($totalComedia ?? 0); ?></td>
            </tr>
            <tr>
                <td>Ação</td>
                <td><?php echo e($totalAcao ?? 0); ?></td>
            </tr>
            <tr>
                <td>Drama</td>
                <td><?php echo e($totalDrama ?? 0); ?></td>
            </tr>
            <tr>
                <td>Animação</td>
                <td><?php echo e($totalAnimacao ?? 0); ?></td>
            </tr>
        </tbody>
    </table>
</div>


<div class="box-table" style="margin-top: 24px;">
    <h3 style="margin: 12px 0;">Comédia (<?php echo e($totalComedia ?? 0); ?>)</h3>
    <ul>
        <?php $__empty_1 = true; $__currentLoopData = ($filmesComedia ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><?php echo e($f->titulo); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>Nenhum filme de Comédia.</li>
        <?php endif; ?>
    </ul>

    <h3 style="margin: 12px 0;">Ação (<?php echo e($totalAcao ?? 0); ?>)</h3>
    <ul>
        <?php $__empty_1 = true; $__currentLoopData = ($filmesAcao ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><?php echo e($f->titulo); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>Nenhum filme de Ação.</li>
        <?php endif; ?>
    </ul>

    <h3 style="margin: 12px 0;">Drama (<?php echo e($totalDrama ?? 0); ?>)</h3>
    <ul>
        <?php $__empty_1 = true; $__currentLoopData = ($filmesDrama ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><?php echo e($f->titulo); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>Nenhum filme de Drama.</li>
        <?php endif; ?>
    </ul>

    <h3 style="margin: 12px 0;">Animação (<?php echo e($totalAnimacao ?? 0); ?>)</h3>
    <ul>
        <?php $__empty_1 = true; $__currentLoopData = ($filmesAnimacao ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><?php echo e($f->titulo); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>Nenhum filme de Animação.</li>
        <?php endif; ?>
    </ul>
</div>

</main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gisel\Desktop\DS-Etec\3-MODULO\PW3\codeflix-site\resources\views/auth/dashboard.blade.php ENDPATH**/ ?>
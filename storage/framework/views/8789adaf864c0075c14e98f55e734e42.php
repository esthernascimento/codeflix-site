<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">

<div class="dashboard">
    <!-- Menu lateral -->
    <aside class="sidebar">
        <ul>
            <li><a href="#"><i class="bi bi-house-door-fill"></i></a></li>
            <li><a href="<?php echo e(url('/suporte.blade.php')); ?>"><i class="bi bi-people-fill"></i></a></li>
            <li><a href="#"><i class="bi bi-question-circle-fill"></i></a></li>
            <li><a href="#"><i class="bi bi-lock-fill"></i></a></li>
            <li>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
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
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gisel\Desktop\DS-Etec\3-MODULO\PW3\codeflix-site\resources\views/auth/dashboard.blade.php ENDPATH**/ ?>
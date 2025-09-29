<?php $__env->startSection('content'); ?>
<div class="form-container">
    <h1>Editar Membro</h1>

    <form action="<?php echo e(route('membros.update', $membro)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo e($membro->nome); ?>" required>

        <label>Usuário Instagram:</label>
        <input type="text" name="usuario_instagram" value="<?php echo e($membro->usuario_instagram); ?>">

        <label>Imagem:</label>
        <input type="file" name="imagem">
        <?php if($membro->imagem): ?>
            <img src="<?php echo e(asset('storage/' . $membro->imagem)); ?>" alt="Imagem atual">
        <?php endif; ?>

        <button type="submit">Atualizar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Desktop/ETEC/codeflix-site/resources/views/membros/edit.blade.php ENDPATH**/ ?>
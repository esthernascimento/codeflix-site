

<?php $__env->startSection('content'); ?>
<h1>Adicionar Membro</h1>
<form action="<?php echo e(route('membros.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <label>Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label>Usuário Instagram:</label>
    <input type="text" name="usuario_instagram"><br><br>

    <label>Imagem:</label>
    <input type="file" name="imagem"><br><br>

    <button type="submit">Salvar</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HYAGO\Desktop\CINE\codeflix-site\resources\views/membros/create.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1> Filmes </h1>

    <?php $__currentLoopData = $filmes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p> <?php echo e($f->titulo); ?> <?php echo e($f->genero); ?> <?php echo e($f->classificacao); ?></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

   
    
</body>
</html>
<?php /**PATH C:\Users\gisel\Desktop\DS-Etec\3-MODULO\PW3\codeflix-site\resources\views/filme_pdf.blade.php ENDPATH**/ ?>
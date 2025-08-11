<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeFlix</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(url('css/home.css')); ?>">
</head>
<body>
      <header>
        <div class="interface">
            <div class="logo">
                <a href="#">
                    <img src="<?php echo e(asset('img/codeflix-white.png')); ?>" class="logo">
                </a>
            </div>

            <nav class="menu-desktop">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">EM CARTAZ</a></li>
                    <li><a href="<?php echo e(url('/contato')); ?>">CONTATO</a></li>
                    <li><a href="<?php echo e(url('/sobre')); ?>">QUEM SOMOS</a></li>
                </ul>
            </nav>

            <div class="btn-contato">
                <a href="#">
                    <button>MINHA CONTA</button>
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="descricao">
            <h1>SUA PRÓXIMA <br>SESSÃO</h1>
            <p>COMEÇA AQUI</p>
        </div>

        <section class="movies">
            <div class="container-cards">
            <?php $__currentLoopData = $filmes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card-movie">
                    <div class="poster">
                        <img src="<?php echo e(asset('img/'.$filme->imagem)); ?>" alt="<?php echo e($filme->titulo); ?>">
                        <span class="classificacao _<?php echo e(strtolower($filme->classificacao)); ?>">
                            <?php echo e($filme->classificacao); ?>

                        </span>
                    </div>
                    <div class="info">
                        <h3><?php echo e($filme->titulo); ?></h3>
                        <p><?php echo e($filme->genero); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

    </main>

</body>

</html><?php /**PATH C:\Users\userlocal\Downloads\codeflix-site\resources\views/home.blade.php ENDPATH**/ ?>
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
            <li><a href="<?php echo e(route('logout')); ?>">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"><i class="bi bi-box-arrow-right"></i></button>
                </form>
            </a></li>
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
        <tr>
          <td>Esther Nascimento</td>
          <td>esther@gmail.com</td>
          <td>oiiie</td>
          <td class="actions">
            <a href="#"><i class="bi bi-pencil" title="Editar"></i></a>
            <a href="#"><i class="bi bi-slash-circle" title="Desativar"></i></a>
            <a href="#"><i class="bi bi-trash" title="Excluir"></i></a>
          </td>
        </tr>
        <tr>
          <td>Gisele Nunes</td>
          <td>gisele@gmail.com</td>
          <td>tudo bem?</td>
          <td class="actions">
            <a href="#"><i class="bi bi-pencil" title="Editar"></i></a>
            <a href="#"><i class="bi bi-slash-circle" title="Desativar"></i></a>
            <a href="#"><i class="bi bi-trash" title="Excluir"></i></a>
          </td>
        </tr>
    </tbody>
  </table>
</div>
 
 
    </div>


    </main>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\codeflix-site\resources\views/auth/dashboard.blade.php ENDPATH**/ ?>
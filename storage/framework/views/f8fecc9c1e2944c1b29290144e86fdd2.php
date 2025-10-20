<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Filmes</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
            padding: 40px;
            background-color: #fff;
        }

        h1 {
            text-align: center;
            color: #b30000;
            font-size: 22px;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        p {
            margin-bottom: 5px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            color: #b30000;
            font-weight: bold;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #b30000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }

        thead {
            background-color: #b30000;
            color: #fff;
        }

        th, td {
            padding: 8px 10px;
            text-align: left;
        }

        th {
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #888;
        }

        .logo-area {
            text-align: right;
            margin-bottom: 20px;
        }

        .logo-area img {
            width: 120px;
        }

        @page {
            margin: 40px 30px;
        }

        tr, td, th {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>

    <h1>Relatório de Filmes</h1>

    <div class="container">
        <div class="section">
            <div class="section-title">Lista de Filmes</div>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Gênero</th>
                        <th>Classificação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $filmes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($f->titulo); ?></td>
                            <td><?php echo e($f->genero); ?></td>
                            <td><?php echo e($f->classificacao); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        Gerado automaticamente pelo sistema | <?php echo e(date('d/m/Y H:i')); ?>

    </div>

</body>
</html><?php /**PATH C:\Users\gisel\Desktop\DS-Etec\3-MODULO\PW3\codeflix-site\resources\views/filme_pdf.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1> Filmes </h1>

    @foreach($filmes as $f)
        <p> {{$f->titulo}} {{$f->genero}} {{$f->classificacao}}</p>
    @endforeach

   
    
</body>
</html>

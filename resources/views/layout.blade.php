<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Séries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/83d2746f22.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('listar_series') }}">Home</a>
        @auth
        <a href="/sair" class="nav-link text-danger">Sair</a>
        @endauth

        @guest
            <a href="/entrar" class="text-primary">Entrar</a>
        @endguest
    </div>
</nav>
<div class="container">
    <div class="container-fluid py-5 p-5 bg-dark bg-opacity-10 mb-2 rounded-2">
        <h1>@yield('cabecalho')</h1>
    </div>

    @yield('conteudo')
</div>
</body>
</html>

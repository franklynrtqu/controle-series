@extends('layout')

@section('cabecalho')
    Entrar
@endsection

@section('conteudo')
    @include('errors', ['errors' => $errors])
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password"></label>
            <input type="password" name="password" id="password" required min="1" class="form-control">
        </div>

        <button class="btn btn-primary mt-3">
            Entrar
        </button>

        <a href="/registrar" class="btn btn-secondary mt-3">
            Registrar-se
        </a>
    </form>
@endsection
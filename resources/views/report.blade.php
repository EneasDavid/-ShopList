@extends('layout')
@section('header')    

@endsection

@section('main')
<header class="header">
<nav class="navbar navbar-expand-lg header-nav fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index">ShopList</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/dashboard">Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="report">Relatório</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mais
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="historic">Histórico</a></li>
            <li><a class="dropdown-item" href="settings">Configurações</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout">Sair</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
      <a href="new_list" class="btn">Nova Lista</a>
      </ul>
    </div>
  </div>
</nav>       
</header>
<main>
    <input style="background-color: #54a666; width:100%;" type="range" id="limite" name="limite" min="0" max="{{$lAbertas[1]->valorTotal}}" value="{{$lAbertas[1]->valorTotal}}" disabled>
    {{--<input style="background-color: #b5acac;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
    <input style="background-color: #54a666;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
    <input style="background-color: #e6d53a;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>--}}
</main>
@endsection
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
          <a class="nav-link active" aria-current="page" href="/dashboard">Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="report">Relatório</a>
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
     
    </div>
  </div>
</nav>       
</header>
<body>
  <div class="row mb-4">
      <div class="container-perfil col-md-6 " style="justify-content:end!important">
      
        <div class="box">
        <form method="POST" action="{{route('adicionarFotoPerfil')}}" enctype="multipart/form-data">
          @if(isset($usuario->foto))
          <label tabIndex="0" for="picture__input" type="file" class="fotoPerfil picture" style="padding:0px!important" onchange="this.form.submit()">
            <img src="/{{$usuario->foto}}" alt="" style="height: 12rem;width: 12rem;border-radius: inherit;">
          </label>
          @else
          <label tabIndex="0" for="picture__input" type="file" class="fotoPerfil picture" style="background: rgb(219, 221, 223);" onchange="this.form.submit()">
            <img src="/user.png" style="height: 6.5rem; width:6.5rem;"></img>
          </label>
          @endif
          <input type="file" id="picture__input" name="foto" >
        </form>
        </div>
      </div>
      <div class="container-perfil col-md-6" style="justify-content:flex-start !important">
        <div class="card">
        <div class="form-control border-dark">
          <div style="margin-left: 5rem; margin-right: 5rem;" >
            <h4 style="color: #1f2029;">Olá {{$usuario->name}}</h4>
            <p style="color: #1f2029;">Email: {{$usuario->email}}</p>
            <p style="color: #1f2029;">Quantidade de Listas ativas: {{$lAbertas}}</p>
            <p style="color: #1f2029;">Quantidade de Listas finalizadas: {{$lFinalizadas}}</p>
            <p style="color: #1f2029;">Quantidade de Listas participando: </p>
            </div>
          </div>
        </div>
      </div>
  </div>
</body>
@endsection
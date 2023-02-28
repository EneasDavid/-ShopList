@extends('layout')
@section('header')    

@endsection

@section('main')
<header class="header">
  <nav class="navbar navbar-expand-lg header-nav fixed-top">
    <div class="container-fluid">
    @auth
    <a class="navbar-brand" href="/home">ShopList</a>
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
          <a class="nav-link" href="/report">Relatório</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mais
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="historic">Histórico</a></li>
            <li><a class="dropdown-item active" href="/donation">Doação</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout">Sair</a></li>
          </ul>
        </li>
        @endauth
        @guest
        <a class="navbar-brand" href="/">ShopList</a>
        @endguest
      </ul>
    </div>
  </div>
</nav>       
</header>
<body>
<a href="/home" style="padding-left: calc(var(--bs-gutter-x) * 1.1);"><img style="height: 30px;" src="previous.png" alt="back to home page"></a>
<div class="col-md-12 centered mx-auto container-perfil" style="width: max-content;">
<div style="display: flex;background: white;flex-direction: row;justify-content: space-between;align-items: center;border-radius: 25px;box-shadow: 4px 8px 10px 2px #32333e;">
        <div class="box" style="width:200px !important;height:auto !important;">
        <h4 style="color: #1f2029;">Nos ajude a continuar melhorando esse projeto, paga um cafezinho pra gente!</h4>
        </div>
        <div class="box" style="height:auto !important;">
          <label tabIndex="0" for="picture__input" type="file" class="fotoPerfil picture" style="display: flex;flex-direction: column;align-items: center;padding:0px!important">
          <h4 style="color:#1f2029">PIX:</h4>  
          <img src="/pix.jpeg" alt="" style="height: 12rem;width: 12rem;">
          </label>
        </div>
      </div>
  </div>
  </div>
</body>
@endsection
@extends('layout')
@section('header')    

@endsection

@section('main')
<header class="header">
<nav class="navbar navbar-expand-lg header-nav fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand" href="/home">ShopList</a>
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
          <a class="nav-link" href="/report">Relatório</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mais
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="historic">Histórico</a></li>
            <li><a class="dropdown-item" href="/donation">Doação</a></li>
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
    <a href="/home"><img style="height: 30px;" src="previous.png" alt="back to home page"></a>
      <div class="container-perfil col-md-6 " style="justify-content:end!important">
      
        <div class="box" style="margin-top: 4vh !important;">
        <form style="display: flex;flex-direction: column;" method="POST" action="{{route('adicionarFotoPerfil')}}" enctype="multipart/form-data">
        @csrf 
        @if(!empty($usuario->foto))
          <label tabIndex="0" for="picture__input" type="file" class="fotoPerfil picture" style="padding:0px!important">
            <img class="img-perfil" src="/{{$usuario->foto}}" alt="Não foi possível carregar sua foto" style="height: 15rem;width: 15rem;border-radius: inherit;" title="click aqui para mudar sua foto de perfil">
          </label>
          @else
          <label tabIndex="0" for="picture__input" type="file" class="fotoPerfil picture" style="background: rgb(219, 221, 223);">
            <img src="/user.png" style="height: 15rem;width: 15rem;border-radius: inherit;" title="click aqui para adicionar uma foto ao seu perfil"></img>
          </label>
          @endif
          <input type="file" id="picture__input" name="foto" onchange="this.form.submit()">
        </form>
        </div>
      </div>
      <div class="container-perfil col-md-6" style="justify-content:flex-start !important">
        <div class="card">
        <div class="form-control border-dark">
          <div style="margin-left: 5rem; margin-right: 5rem;" >
            <div style="display: flex;width: 75%;justify-content: space-between;"><h4 style="color: #1f2029;" id="saudacao"> </h4><h4 style="color: #1f2029;">  {{$usuario->name}}</4></div>
            <p style="color: #1f2029;">Email: {{$usuario->email}}</p>
            <p style="color: #1f2029;">Quantidade de Listas ativas: {{$lAbertas}}</p>
            <p style="color: #1f2029;">Quantidade de Listas finalizadas: {{$lFinalizadas}}</p>
            <p style="color: #1f2029;">Quantidade de Listas participando:{{$usuario->lParticipando}} </p>
            </div>
          </div>
        </div>
      </div>
  </div>
  <script src="/jquery.js"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="/script.js"></script>
    <script src="/saudacao.js"></script>
</body>
@endsection
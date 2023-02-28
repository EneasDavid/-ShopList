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
            <li><a class="dropdown-item active" href="/historic">Histórico</a></li>
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

@if (empty($suasListas->toArray()) and empty($listasParticipa))
<body>
<div class="col-md-12 centered mx-auto container-perfil" style="width: max-content;">
<div style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
     <h1>Nenhuma lista disponivel.</h1>
  </div>
</div>
</body>
@else
<div class="container">
      <hr class="mt-3">
      <div class="row">
        <div class="col-12 col-md-5">
          <form class="justify-content-center justify-content-md-start mb-3 mb-md-0">
            <div class="input-group input-group-sm">
              <form action="/historic" method="get">
              <input type="text" class="form-control" name="pesquisa" placeholder="Digite aqui o que procura">
              <button class="btn btn-danger">Buscar</button>
              </form>
            </div>
          </form>
        </div>
        <div class="col-12 col-md-7">
          <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
          <form action="/historic" method="get" ml-3 d-inline-block>
              <select name="pesquisa" class="form-select" onchange="this.form.submit()">
                <option selected disabled>Ordernar por...</option>
                <option value="old">Ordernar do Antigo para o Mais Novo</option>
                <option value="now">Ordernar do Mais Novo para o Mais Antigo</option>
              </select>
            </form>
            </div>
        </div>
      </div>
      <hr class="mt-3">
      <div class="row" style="justify-content: normal !important;">
      @foreach($suasListas as $listas)
        <div class="col-md-4 col-xl-3 col-lg-6">
          <div class="row " style="justify-content: normal !important;">
            <a href='/list/{{$listas->id}}'>
              <div class="col-xl-12 col-lg-12">
                <div class="card l-bg-orange-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">{{$listas->nome}}</h5>
                            <p class="card-text truncate-3l">{{$listas->categoria}}</p>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                R$ {{str_replace(".",",",$listas->valorTotal)}}
                                </h2>
                            </div>
                            <div class="col-4 text-right" style="height: 3rem;">
                                <span> Limite: R$ {{str_replace(".",",",$listas->limiteLista)}}</span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        @if(!isset($listas->limiteLista))
                        <input style="background-color: #54a666;width:100%;" type="range" id="limite" name="limite" min="0" max="{{$listas->valorTotal}}" value="  {{$listas->valorTotal}}" disabled>
                        @else
                          @if($listas->valorTotal<=(($listas->limiteLista/10)*9))
                          <input style="background-color: #b5acac;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
                          @elseif($listas->valorTotal>=(($listas->limiteLista/10)*9) and $listas->valorTotal<=$listas->limiteLista)
                          <input style="background-color: #54a666;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
                          @else
                          <input style="background-color: #e6d53a;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
                          @endif
                        @endif
                        </div>
                    </div>
                    </div>
            </div>
            </a>
          </div>
        </div>
        @endforeach
      @foreach($listasParticipa as $listas)
        <div class="col-md-4 col-xl-3 col-lg-6">
          <div class="row " style="justify-content: normal !important;">
            <a href='/list/{{$listas->id}}'>
              <div class="col-xl-12 col-lg-12">
                <div class="card l-bg-orange-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">{{$listas->nome}}</h5>
                            <p class="card-text truncate-3l">{{$listas->categoria}}</p>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                R$ {{$listas->valorTotal}}
                                </h2>
                            </div>
                            <div class="col-4 text-right" style="height: 3rem;">
                                <span> Limite: R$ {{$listas->limiteLista}}</span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        @if(!isset($listas->limiteLista))
                        <input style="background-color: #54a666;width:100%;" type="range" id="limite" name="limite" min="0" max="{{$listas->valorTotal}}" value="  {{$listas->valorTotal}}" disabled>
                        @else
                          @if($listas->valorTotal<=(($listas->limiteLista/10)*9))
                          <input style="background-color: #b5acac;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
                          @elseif($listas->valorTotal>=(($listas->limiteLista/10)*9) and $listas->valorTotal<=$listas->limiteLista)
                          <input style="background-color: #54a666;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
                          @else
                          <input style="background-color: #e6d53a;width:{{$listas->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
                          @endif
                        @endif
                        </div>
                    </div>
                    </div>
            </div>
            </a>
          </div>
        </div>
        @endforeach
    @endif
@endsection
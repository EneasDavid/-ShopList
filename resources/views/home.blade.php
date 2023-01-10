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
          <a class="nav-link active" aria-current="page" href="profile">Perfil</a>
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
            <li><a class="dropdown-item" href="donation">Doação</a></li>
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

@if (empty($suasListas->toArray()))
  <div class="col-md-12 centered mx-auto" style="width: max-content;">
     <h1>Nenhuma lista disponivel.</h1>
  </div>
@else
<div class="container">
      <hr class="mt-3">
      <div class="row">
        <div class="col-12 col-md-5">
          <form class="justify-content-center justify-content-md-start mb-3 mb-md-0">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="Digite aqui o que procura">
              <button class="btn btn-danger">
                  Buscar
              </button>
            </div>
          </form>
        </div>
        <div class="col-12 col-md-7">
          <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
            <form ml-3 d-inline-block>
              <select class="form-select">
                <option value="1">Ordernar pelo nome</option>
                <option value="2">Ordernar do Mais Novo para o Mais Antigo</option>
                <option value="3">Ordernar do Antigo para o Mais Novo</option>
              </select>
            </form>
              <div class="btn-group me-3" role="group" aria-label="First group">
                <button type="button" class="btn btn-outline-secondary disabled">1</button>
                <button type="button" class="btn btn-outline-secondary">2</button>
                <button type="button" class="btn btn-outline-secondary">3</button>
                <button type="button" class="btn btn-outline-secondary">4</button>
              </div>
          </div>
        </div>
      </div>
      <hr class="mt-3">
      <div class="row">
      @foreach($suasListas as $listas)
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
          <div class="card text-center bg-light">
            <img src="" class="card-img-top"><!--img da lista-->
            <div class="card-header" style="display: flex;flex-direction: row;align-items: center;justify-content: space-around;">
              @if(!isset($listas->limiteLista))
                <p style="color:#54a666">R$ {{$listas->valorTotal}}</p>
                <input style="background-color: #54a666;" type="range" id="limite" name="limite" min="0" max="{{$listas->valorTotal}}" value="{{$listas->valorTotal}}" disabled>
              @else
                @if($listas->valorTotal<=$listas->limiteLista)
                  <p title="Valor total dos produtos" style="color:#54a666">R$ {{$listas->valorTotal}}</p>
                  <input style="background-color: #54a666;" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
                  <p title="Limite previsto" style="color:#54a666">R$ {{$listas->limiteLista}}</p>
                @else
                  <p title="Valor total dos produtos" style="color:#e6d53a">R$ {{$listas->valorTotal}}</p>
                  <input style="background-color: #e6d53a;" type="range" id="limite" name="limite" min="0" max="{{$listas->limiteLista}}" value="{{$listas->valorTotal}}" disabled>
                  <p style="color:#e6d53a" title="Limite previsto">R$ {{$listas->limiteLista}}</p>
                @endif
              @endif
            </div>
            <div class="card-body">
              <h5 class="card-title text-dark"><strong>{{$listas->nome}}</strong><!--Nome da Lista--></h5>
              <p class="card-text truncate-3l">{{$listas->categoria}}</p>
            </div>
            <div class="card-footer">
              <form class="d-block">
                <a href='/list/{{$listas->id}}'class="btn btn-danger">Ver Lista</a>
              </form>
              @if(isset($listas->quantidadeItem))
                <small class="text-success">{{$listas->quantidadeItem}} <!--Quantidade de produtos na lista--></small>
              @else
                <small class="text-success">Não há produtos cadastrados <!--Quantidade de produtos na lista--></small>
              @endif
            </div>
          </div>
        </div>
          @endforeach
        </div>
    </div> 
@endif

@endsection
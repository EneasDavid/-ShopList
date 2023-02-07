@extends('layout')
@section('header')    

@endsection

@section('main')
<header class="header">
   <!--Icons-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
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
          <a class="nav-link active" href="/report">Relatório</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mais
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/historic">Histórico</a></li>
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
<main>
  <br>
  <br>
    <div class="d-flex justify-content-center "style="flex-direction: column;
    align-items: center;">
      <form class="forms-pesquisa" style="display: flex;" action="/report" method="get">
      @csrf
        <select name="search" class="form-select filtrarMes" name="" id="">
          <option selected disabled>Mês</option>
          <option value="01">Janeiro</option>
          <option value="02">Fevereirio</option>
          <option value="03">Março</option>
          <option value="04">Abril</option>
          <option value="05">Maio</option>
          <option value="06">Junho</option>
          <option value="07">Julho</option>
          <option value="08">Agosto</option>
          <option value="09">Setembro</option>
          <option value="10">Outubro</option>
          <option value="11">Novembro</option>
          <option value="12">Dezembro</option>
        </select>
        <button class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
      </form>
      <br>
      <div class="table-responsive">
        @if(!empty($acima) and !empty($semlimite) and !empty($nolimite))
        <table class="table">
          <thead>
            <tr>
              <th>Acima do esperado</th>
              <th>No limite</th>
              <th>sem limite previsto</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><h7>{{count($acima)}}</h7></td>
              <td><h7>{{count($nolimite)}}</h7></td>
              <td><h7>{{count($semlimite)}}</h7></td>
            </tr>
          </tbody>
        </table>
        @endif
  </div>
</main>
@endsection
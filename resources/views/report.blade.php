@extends('layout')
@section('header')    

@endsection

@section('main')
<header class="header">
   <!--Icons-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
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
<a href="/home" style="padding-left: calc(var(--bs-gutter-x) * .5);"><img style="height: 30px;" src="previous.png" alt="back to home page"></a>
  <br>
  <br>
    <div class="d-flex justify-content-center "style="flex-direction: column;
    align-items: center;">
      <form class="forms-pesquisa" style="display: flex;" action="/report" method="get">
      @csrf
        <select name="search" class="form-select filtrarMes" name="" id="">
          <option selected disabled>Mês</option>
          @if(date('m')>='01')
          <option value="01" {{$search=="01"?"selected='selected'":""}}>Janeiro</option>
          @endif
          @if(date('m')>='02')
          <option value="02" {{$search=="02"?"selected='selected'":""}}>Fevereirio</option>
          @endif
          @if(date('m')>='03')
          <option value="03" {{$search=="03"?"selected='selected'":""}}>Março</option>
          @endif
          @if(date('m')>='04')
          <option value="04" {{$search=="04"?"selected='selected'":""}}>Abril</option>
          @endif
          @if(date('m')>='05')
          <option value="05" {{$search=="05"?"selected='selected'":""}}>Maio</option>
          @endif
          @if(date('m')>='06')
          <option value="06" {{$search=="06"?"selected='selected'":""}}>Junho</option>
          @endif
          @if(date('m')>='07')
          <option value="07" {{$search=="07"?"selected='selected'":""}}>Julho</option>
          @endif
          @if(date('m')>='08')
          <option value="08" {{$search=="08"?"selected='selected'":""}}>Agosto</option>
          @endif
          @if(date('m')>='09')
          <option value="09" {{$search=="09"?"selected='selected'":""}}>Setembro</option>
          @endif
          @if(date('m')>='10')
          <option value="10" {{$search=="10"?"selected='selected'":""}}>Outubro</option>
          @endif
          @if(date('m')>='11')
          <option value="11" {{$search=="11"?"selected='selected'":""}}>Novembro</option>
          @endif
          @if(date('m')>='12')
          <option value="12" {{$search=="12"?"selected='selected'":""}}>Dezembro</option>
          @endif
        </select>
        <button class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
      </form>
      <br>
      <div style="display: flex;width: 90%;justify-content: space-around;">
        <div style="background: white;border-radius: 20px;padding: 1rem;margin-right: 10rem;width: 25%;">
        <h4><small>Gasto esse mês:</small><br><strong style="color:#e9d937">R$ {{str_replace(".",",",$gastosDoMes)}}</strong></h4>
        <table class="table">
        @foreach ($listas as $li)
        <tbody>
            <tr>
              <td class="color" style="border-bottom-width:0px !important"><a href="/list/{{$li['id']}}"><h7 style="justify-content: flex-start !important;">{{$li['nome']}}</h7></a></td>
              <td class="color" style="border-bottom-width:0px !important"><h7 style="justify-content: flex-end;">{{str_replace(".",",",$li['valorTotal'])}}</h7></td>
            </tr>
          </tbody>
         @endforeach
        </table>
        </div>
        <table class="table" style="width: auto;">
          <thead>
            <tr>
            @if(date('m')>='01')
            <td>
              <div style="display: grid;justify-items: center;justify-content: space-around;">
                <div class="slider-wrapper">
                  <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                    @php
                    $porcentagem=($gastosDoJ/$maximo)*100;
                    echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoJ.'" step="1">'
                    @endphp
                  </div>
                </div>
                <div>
                  <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoJ)}}</h7>
                </td>
              </div>
            </div>
            @endif
            @if(date('m')>='02')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoF/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoF.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoF)}}</h7>
                  </div>
                </div>
              </td>
            @endif
           @if(date('m')>='03')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                <div class="slider-wrapper">
                <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                @php
                  $porcentagem=($gastosDoM/$maximo)*100;
                  echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoM.'" step="1">'
                @endphp
                </div>
                </div>
                <div>
                  <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoM)}}</h7>
                </div>
                </div>
              </td>
               @endif
               @if(date('m')>='04')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoAb/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoAb.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoAb)}}</h7>
                  </div>
                </div>
              </td>
              @endif
              @if(date('m')>='05')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoMa/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoMa.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoMa)}}</h7>
                  </div>
                </div>
                @endif
                @if(date('m')>='06')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoJu/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoJu.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoJu)}}</h7>
                  </div>
                </div>
                 @endif
                @if(date('m')>='07')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoJl/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoJl.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoJl)}}</h7>
                  </div>
                </div>
                 @endif
             @if(date('m')>='08')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoA/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoA.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoA)}}</h7>
                  </div>
                </div>
                 @endif
              @if(date('m')>='09')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoS/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoS.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoS)}}</h7>
                  </div>
                </div>
                @endif
                @if(date('m')>='10')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoO/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoO.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoO)}}</h7>
                  </div>
                </div>
                @endif
                  @if(date('m')>='11')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoN/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoN.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoN)}}</h7>
                  </div>
                </div>
                 @endif
            @if(date('m')>='12')
              <td>
                <div style="display: grid;justify-items: center;justify-content: space-around;">
                  <div class="slider-wrapper">
                    <div class="progress mt-1 " style="transform: rotate(180deg);height: inherit;">
                      @php
                      $porcentagem=($gastosDoD/$maximo)*100;
                      echo '<input style="background-color:darkgray;height:'.$porcentagem.'%" type="range" min="0" max="'.$maximo.'" value="'.$gastosDoD.'" step="1">'
                      @endphp
                    </div>
                  </div>
                  <div>
                    <h7 style="display: grid;justify-items: center;">{{str_replace(".",",",$gastosDoD)}}</h7>
                  </div>
                </div>
                 @endif
             </tr>
            </tr>
          </thead>
          <tbody>
            <tr>
            @if(date('m')>='01')
              <th><h7 style="display: grid;justify-items: center;">Jan.</h7></th>
                  @endif
                @if(date('m')>='02')
              <th><h7 style="display: grid;justify-items: center;">Fev.</h7></th>
                 @endif
                    @if(date('m')>='03')
              <th><h7 style="display: grid;justify-items: center;">Mar.</h7></th>
                  @endif
                    @if(date('m')>='04')
              <th><h7 style="display: grid;justify-items: center;">Abr.</h7></th>
                  @endif
                    @if(date('m')>='05')
              <th><h7 style="display: grid;justify-items: center;">Mai.</h7></th>
                  @endif
                    @if(date('m')>='06')
              <th><h7 style="display: grid;justify-items: center;">Jun.</h7></th>
                   @endif
                    @if(date('m')>='07')
              <th><h7 style="display: grid;justify-items: center;">Jul.</h7></th>
                 @endif
                    @if(date('m')>='08')
              <th><h7 style="display: grid;justify-items: center;">Ago.</h7></th>
                  @endif
                    @if(date('m')>='09')
              <th><h7 style="display: grid;justify-items: center;">Set.</h7></th>
                 @endif
                   @if(date('m')>='11')
              <th><h7 style="display: grid;justify-items: center;">Out.</h7></th>
                  @endif
                    @if(date('m')>='10')
              <th><h7 style="display: grid;justify-items: center;">Nov.</h7></th>
                @endif
                   @if(date('m')>='12')
              <th><h7 style="display: grid;justify-items: center;">Dev.</h7></th>
                 @endif
             </tr>
          </tbody>
        </table>
  </div>
</main>
@endsection
@extends('layout')
@section('header')    

@endsection

@section('main')
<link href="/style.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

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
      @if($lista->finaizada==0)
        <ul class="navbar-nav ms-auto">
          <button type="button" class="btn" data-target="#modalExemplo" data-salvar onclick="chamaPopUp()">Adicionar Produto</button>
        </ul>
      @endif
    </div>
  </div>
</nav>       
</header>
<main class="fix-fill">
<div class="modal pagina aparecer" id="modalExemplo" tabindex="-1" role="dialog" style="margin: 0!important;" aria-labelledby="exampleModalLabel" aria-hidden="true" popUp-cadastrar-tag>
<div class="section">
    <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
                <div class="card-3d-wrap mx-auto">
                    <div class="card-3d-wrapper">
                        <div class="card-front">
                            <div class="center-wrap">
                                <a href="/list/{{$lista->id}}"type="button" class="btn-close btn-close-white" aria-label="Close" data-dismiss="modal"></a>
                                <div class="section text-center">
                                    <h4 class="mb-4 pb-3">Adicionar Produto</h4>
                                    <form class="container" action="/listItemChange?l={{$lista->id}}&item={{$itemE->id}}" method="POST">
                                    @csrf
                                    <input type="hidden" class="id" name="id">
                                        <div class="form-group">
                                            <input type="text" name="nome" class="form-style input-home nome" placeholder="Nome do Produto" id="logname" autocomplete="off" value='{{$itemE->nomeProduto}}'>
                                            <i class="input-icon uil uil-user"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="number" step="0.01" name="preco" class="form-style input-home preco" placeholder="Preço do produto" id="logname" autocomplete="off" value='{{$itemE->preco}}'>
                                            <i class="input-icon uil uil-user"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="number" name="quantidade" class="form-style input-home quantidade" placeholder="Quantidade do produto" id="logname" autocomplete="off" value='{{$itemE->quantidade}}'>
                                            <i class="input-icon uil uil-user"></i>
                                        </div>	
                                        <div class="form-group mt-2">
                                            <input type="text" name="descricao" class="form-style input-home descricao" placeholder="Descrição do produto" id="logname" autocomplete="off" value='{{$itemE->descricao}}'>
                                            <i class="input-icon uil uil-user"></i>
                                        </div>	
                                        <button class="btn" type="submit" onclick="myFunction(this);this.form.submit()">Alterar</button>
                                    </form>
                                </div>
                           </div>
                       </div>  
                   </div>
               </div>
       </div>
    </div>
</div>
</div>
  <div class="container">
  </br>
  <div style="display: inline-flex;flex-direction: row;justify-content: space-between;align-items: baseline;width: inherit;">
    <h1  class="truncate-1l" style="width: 40%" title="{{$lista->nome}}">{{$lista->nome}}</h1>
    <button type="button" class="btn" data-target="#modalExemplo" data-salvar onclick="chamaPopUpIntegrantes()">Integrantes</button>
    <div style="display: inline-flex;flex-direction: row;justify-content: space-around;align-items: baseline;width: 40%;justify-content: flex-end;">  
    @if(!isset($lista->limiteLista))
      <p style="color:#54a666;margin-right: 1rem;">R$ {{str_replace(".",",",$lista->valorTotal)}}</p>
      @else
      @if($lista->valorTotal<=(($lista->limiteLista/10)*9))
      <p style="color:#b5acac;margin-right: 1rem;">R$ {{str_replace(".",",",$lista->valorTotal)}}</p>
      @elseif($lista->valorTotal>=(($lista->limiteLista/10)*9) and $lista->valorTotal<=$lista->limiteLista)
      <p style="color:#54a666;margin-right: 1rem;">R$ {{str_replace(".",",",$lista->valorTotal)}}</p>
      @else
      <p style="color:#e6d53a;margin-right: 1rem;">R$ {{str_replace(".",",",$lista->valorTotal)}}</p>
      @endif
      @endif
      <div class="progress mt-1 " data-height="8" style="height: 8px;">
        @if(!isset($lista->limiteLista))
        <input style="background-color: #54a666;width:100%;" type="range" id="limite" name="limite" min="0" max="{{$lista->valorTotal}}" value="  {{$lista->valorTotal}}" disabled>
        @else
          @if($lista->valorTotal<=(($lista->limiteLista/10)*9))
          <input style="background-color: #b5acac;width:{{$lista->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$lista->limiteLista}}" value="{{$lista->valorTotal}}" disabled>
          @elseif($lista->valorTotal>=(($lista->limiteLista/10)*9) and $lista->valorTotal<=$lista->limiteLista)
          <input style="background-color: #54a666;width:{{$lista->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$lista->limiteLista}}" value="{{$lista->valorTotal}}" disabled>
          @else
          <input style="background-color: #e6d53a;width:{{$lista->porcetagemLimite}}%" type="range" id="limite" name="limite" min="0" max="{{$lista->limiteLista}}" value="{{$lista->valorTotal}}" disabled>
          @endif
        @endif
      </div>
      @if(isset($lista->limiteLista))
          @if($lista->valorTotal<=(($lista->limiteLista/10)*9))
          <p title="Limite previsto" style="color:#b5acac;margin-left: 1rem;">R$ {{str_replace(".",",",$lista->limiteLista)}}</p>
          @elseif($lista->valorTotal>=(($lista->limiteLista/10)*9) and $lista->valorTotal<=$lista->limiteLista)
          <p title="Limite previsto" style="color:#54a666;margin-left: 1rem;">R$ {{str_replace(".",",",$lista->limiteLista)}}</p>
          @else
          <p title="Limite previsto" style="color:#e6d53a;margin-left: 1rem;">R$ {{str_replace(".",",",$lista->limiteLista)}}</p>
          @endif
        @endif
    </div>
    </div>
    <hr>
    <div style="display: flex;align-items: center;justify-content: space-between;">
      <h1>{{$lista->categoria}}</h1>
      @if($lista->idCriador==$user and $lista->finaizada==0)
      <a href="/editList/{{$lista->id}}" type="button" class="btn" >Editar</a>
      @endif
    </div>
    <ul class="list-group mb-3">
    @if(count($items)>0)
      @foreach($items as $item)
      <li class="list-group-item py-3">
        <div class="row g-3" style="justify-content: space-between;">
          <div class="col-8 col-md-9 col-lg-7 col-xl-8 text-left align-self-center">
          <div> 
            <h4><b>{{$item->nomeProduto}}</b></h4>
            <small>Adicionado por: <b>{{$item->responsavelItem}}</b></small>
          </div>
          <h4>
            <small>{{$item->descricao}}</small>
          </h4>
        </div>
        <div class="col-6 offset-6 col-sm-6 offset-sm-6 col-md-4 offset-md-8 col-lg-3 offset-lg-0 col-xl-2 align-self-center mt-3">
          @if($lista->finaizada==0)
          @if($item->idResponsavelItem==$user or $lista->idCriador==$user)
          <div class="input-group">
          <a href="/quantidadeItem?sinal=-&id_item={{$item->id}}&id_lista={{$lista->id}}" onclick="myFunction(this);this.form.submit()"><button type="button" class="botaoLista btn-a btn-sm">
              <span class="bi" width="16" height="16" fill="currentColor">&#x2212;</span>
            </button></a>
            <input type="text" class="form-control text-center border-dark" value="{{$item->quantidade}}"> 
            <a class="botaoLista" href="/quantidadeItem?id_item={{$item->id}}&id_lista={{$lista->id}}&sinal=!" onclick="myFunction(this);this.form.submit()"><button type="button" class="botaoLista btn-a btn-sm">
              <span class="bi" width="16" height="16" fill="currentColor">&#x2b;</span>
            </button></a>
            <form action="/deleteItem?id_item={{$item->id}}&id_lista={{$lista->id}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="botaoLista btn-outline-danger btn-sm" onclick="myFunction(this);this.form.submit()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
              </button>
            </form>
            </div>
            @endif
            @else
            <div style="flex-direction: column;">
            <div class="input-group">
              <h4 class="text-dark mb-3">{{$item->quantidade}}x</h4>
            </div>
            @endif
            <div class="input-group" class="text-end mt-2">
              <small class="text-secondary">Valor UN: R$ {{str_replace(".",",",$item->preco)}}</small><br>
              <span class="text-dark" step="0.01">Valor Item: R$ @php echo str_replace(".",",",($item->preco*$item->quantidade)) @endphp</span>
            </div>
          </div>
        </div>
      </li>
      @endforeach
      @endif

      <li class="list-group-item py-3">
        <div class="text-end">
        @if(count($items)>0)
          <h4 class="text-dark mb-3">
             Valor Total: R$ {{str_replace(".",",",$lista->valorTotal)}}
          </h4>
          @endif

          @if($lista->finaizada==0)
            <a href="/index" class="btn btn-outline-success btn-lg">
              Continuar Depois                           
            </a>
            @if($lista->idCriador==$user and $lista->quantidadeItem>0)
            <a href="/finalizarLista?id={{$lista->id}}" class="btn btn-danger btn-lg ms-2 mt-xs-3">
              Terminar Compra
            </a>
            @endif
            @else
            <h4>Essa lista já foi fianlizada</h4>
            @endif
        </div>
      </li>
    </ul>
  </div>
  <script src="/jquery.js"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="/script.js"></script>
  <script src = "https://code.jquery.com/jquery-3.4.1.min.js" integridade = "sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin = "anonymous" > </script>
  <script src="/cadastroItem.js"></script>
  <script src="/oneClick.js"></script>
</main>  
@endsection
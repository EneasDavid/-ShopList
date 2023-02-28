@extends('layout')
@section('header')    

@endsection

@section('main')

	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3">
							@if(empty($lista))
							<span>Criar </span><span>Participar</span></h6>
							<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
							@else
							<span>Editar </span>
							@endif
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
										@if(empty($lista))
										<a type="button" href="/home" class="btn-close btn-close-white" aria-label="Close"></a>
										@else
										<a type="button" href="/list/{{$lista->id}}" class="btn-close btn-close-white" aria-label="Close"></a>
										@endif
										
										@if(empty($lista))
										<h4 class="mb-4 pb-3">Nova Lista</h4>
										@else
										<h4 class="mb-4 pb-3">Alterar Lista</h4>
										@endif
												@if ($errors->any())
												<div>
											    	<div class="alert alert-danger">
												  		<ul>
														@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
															@break;
														@endforeach
														</ul>
													</div>
													</div>
												@endif
												@if (session('danger'))
													<div class="alert alert-danger">
													{{ session('danger') }}
													</div>
												@endif 
												@if(empty($lista))
												<form action="{{route('criarLista')}}" method="POST">
												@else
												<form action="/editarLista?id={{$lista->id}}" method="POST">
												@endif
												@csrf
												<div class="form-group">
													<input type="text" name="nome" class="form-style" placeholder="Nome*" id="logname" autocomplete="off" value='{{!empty($lista)?"$lista->nome":""}}'>
													<i class="input-icon uil uil-user"></i>
												</div>
												<div class="form-group mt-2">
													<input type="text" name="categoria" class="form-style" placeholder="Categoria*" id="logname" autocomplete="off" value='{{!empty($lista)?"$lista->categoria":""}}'>
													<i class="input-icon uil uil-user"></i>
												</div>
												<div class="form-group mt-2">
													<input type="number" step="0.01" name="limiteLista" class="form-style" placeholder="Limite da lista" id="logname" autocomplete="off" title="Limite da lista é opcional" value='{{!empty($lista)?"$lista->limiteLista":""}}'>
													<i class="input-icon uil uil-user"></i>
												</div>		
												<button type="submit" class="btn mt-4">{{empty($lista)?"CRIAR LISTA":"EDITAR LISTA"}}</button>
												</form>
											</div>
			      						</div>
			      					</div>
									<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
										<a type="button" href="/home" class="btn-close btn-close-white" aria-label="Close"></a>
											<h4 class="mb-4 pb-3">Participar da Lista</h4>
			      						</div>
										  @if (session('danger'))
													<div class="alert alert-danger">
													{{ session('danger') }}
													</div>
											@endif 
										  <form action="{{route('participaAsList')}}" method="POST">
												@csrf
												<div class="form-group">
													<input type="number" name="id" class="form-style" placeholder="Convite*" id="logname" autocomplete="off">
													<i class="input-icon uil uil-user"></i>
												</div>
												<button type="submit" class="btn mt-4">PARTICIPAR</button>
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
	</div>
@endsection
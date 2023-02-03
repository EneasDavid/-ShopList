@extends('layout')
@section('header')    

@endsection

@section('main')

	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Criar </span><span>Participar</span></h6>
			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
										<a type="button" href="/index" class="btn-close btn-close-white" aria-label="Close"></a>
											<h4 class="mb-4 pb-3">Nova Lista</h4>
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
											<form action="{{route('criarLista')}}" method="POST">
												@csrf
												<div class="form-group">
													<input type="text" name="nome" class="form-style" placeholder="Nome*" id="logname" autocomplete="off">
													<i class="input-icon uil uil-user"></i>
												</div>
												<div class="form-group mt-2">
													<input type="text" name="categoria" class="form-style" placeholder="Categoria*" id="logname" autocomplete="off">
													<i class="input-icon uil uil-user"></i>
												</div>
												<div class="form-group mt-2">
													<input type="text" name="limiteLista" class="form-style" placeholder="Limite da lista" id="logname" autocomplete="off" title="Limite da lista é opcional">
													<i class="input-icon uil uil-user"></i>
												</div>		
												<button type="submit" class="btn mt-4">CRIAR LISTA</button>
												</form>
											</div>
			      						</div>
			      					</div>
									<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
										<a type="button" href="/index" class="btn-close btn-close-white" aria-label="Close"></a>
											<h4 class="mb-4 pb-3">Participar da Lista</h4>
			      						</div>
										  <form action="{{route('criarLista')}}" method="POST">
												@csrf
												<div class="form-group">
													<input type="text" name="nome" class="form-style" placeholder="Convite*" id="logname" autocomplete="off">
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
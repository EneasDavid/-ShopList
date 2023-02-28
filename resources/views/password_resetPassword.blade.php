@extends('layout')
@section('header')

@endsection

@section('main')
<div class="section">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
										@if ($errors->any())
											<div>
												<div class="alert alert-danger">
													<ul>
														@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
														@endforeach
													</ul>
												</div></div>
											@endif
											@if (session('danger'))
												<div class="alert alert-danger">
												{{ session('danger') }}
											</div>
											@endif
											<h4>Olá {{$entidade->name}}</h4>
											<h4 class="mb-4 pb-3">Digite sua nova senha</h4>
											<form action="{{route('recSenhaEntidade')}}" method="POST">
												@csrf 
												<div class="form-group">	
													<input type="hidden" name="id" value="{{$entidade->id}}">
													<input type="password" name="senha" class="form-style" placeholder="Informe sua nova senha" id="password" autocomplete="off">
													<i class="input-icon uil uil-at"></i>
												</div>
												<div class="form-group mt-2">	
													<input type="password" name="passwordConfirme" class="form-style" placeholder="Confirme sua nova senha" id="password" autocomplete="off">
													<i class="input-icon uil uil-at"></i>
												</div>	
												<button type="submit" class="btn mt-4">ENVIAR SENHA</button>
											</form>
										</div>
			      					</div>
			      				</div>
			      			</div>  
			      		</div>
		      	</div>
	      	</div>
	</div>
@endsection
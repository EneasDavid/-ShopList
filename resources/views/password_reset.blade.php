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
											<h4 class="mb-4 pb-3">ESQUECEU SUA SENHA DE ACESSO?</h4>
											<form action="{{route('password.email')}}" method="POST">
												@csrf
												<div class="form-group">	
													<input type="email" name="email" class="form-style" placeholder="Informe seu email" id="logemail" autocomplete="off">
													<i class="input-icon uil uil-at"></i>
												</div>	
												<button type="submit" class="btn mt-4">VERIFICAR E-MAIL</button>
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
@extends('layout')
@section('header')    

@endsection

@section('main')

	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Login </span><span>Criar conta</span></h6>
			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Login</h4>
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
											@elseif (session('success'))
											<div class="alert alert-success">
												{{ session('success') }}
											</div>
											@endif
											<form action="{{route('login.forms')}}" method="POST">
											@csrf
											<div class="form-group">
												<input type="email" name="email" class="form-style" placeholder="Email" id="logemail" autocomplete="off">
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" name="password" class="form-style" placeholder="Senha" id="logpass" autocomplete="off">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<button type="submit" class="btn mt-4">ENTRAR</button>
                            				<p class="mb-0 mt-4 text-center"><a href="/password_reset" class="link">Esqueceu a senha?</a></p>
										</form>
										</div>
			      					</div>
			      				</div>
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Criar sua Conta</h4>
											
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
											<form action="{{route('login.cadastro')}}" method="POST">
											@csrf
											<div class="form-group">
												<input type="text" name="name" class="form-style" placeholder="Nome" id="logname" autocomplete="off">
												<i class="input-icon uil uil-user"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="email" name="email" class="form-style" placeholder="Email" id="logemail" autocomplete="off">
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" name="password" class="form-style" placeholder="Senha" id="logpass" autocomplete="off">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<button type="submit" class="btn mt-4">criar seu cadastro</button>
											</forms>
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
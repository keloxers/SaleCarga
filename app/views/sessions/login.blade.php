@extends('layouts.default')
@section('content')

					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes login">
								<div class="col-md-6">
									<div class="featured-box featured-box-secundary default">
										<div class="box-content">
											<h4>Ingresar</h4>
												{{ Form::open(array('action' => 'SessionController@store')) }}
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Direccion de e-mail</label>
															{{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => trans('users.email'), 'autofocus')) }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<a class="pull-right" href="#">(perdio su contraseña ?)</a>
															<label>Contraseña</label>
															{{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('users.pword')))}}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<span class="remember-box checkbox">
															<label for="rememberme">
																{{ Form::checkbox('rememberMe', 'rememberMe') }} {{trans('users.remember')}}?
															</label>
														</span>
													</div>
													<div class="col-md-6">
														<input type="submit" value="Ingresar" class="btn btn-primary pull-right push-bottom" data-loading-text="Ingresando...">
													</div>
												</div>
												{{ Form::close() }}
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="featured-box featured-box-secundary default">
										<div class="box-content">
											<h4>Registrarse</h4>
												{{ Form::open(array('action' => 'UserController@store')) }}
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Direccion de E-mail</label>
															{{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => trans('users.email'))) }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Contraseña</label>
															{{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('users.password'))) }}
														</div>
														<div class="col-md-6">
															<label>Reingresar contraseña</label>
															{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => trans('users.confirm_password'))) }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<input type="submit" value="Registrarse" class="btn btn-primary pull-right push-bottom" data-loading-text="Registrando...">
													</div>
												</div>
												{{ Form::close() }}
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>


@stop

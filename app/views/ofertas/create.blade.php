@extends('layouts.default')

@section('content')


<link rel="stylesheet" href="/scripts/jquery-ui.css">

<script src="/scripts/jquery-ui.js"></script>

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<h2 class="short"><strong>Agregar</strong> nueva oferta</h2>
							{{ Form::open(array('route' => 'ofertas.store', 'class' => 'panel-body wrapper-lg')) }}


								<div class="row">
										<div class="col-md-4">
											<label>Origen</label>
											{{ Form::text('origen', '', ['id' =>  'origen', 'placeholder' =>  '', 'class' => 'form-control input-lg'])}}
											@if ($errors->first('origen_id'))
											<span class="label label-warning">{{ $errors->first('origen_id') }}</span>
											@endif
											{{ Form::hidden('origen_id' , '0', array('id' =>'origen_id')) }}
										</div>
										<div class="col-md-4">
											<label>Destino</label>
											{{ Form::text('destino', '', ['id' =>  'destino', 'placeholder' =>  '', 'class' => 'form-control input-lg'])}}
											@if ($errors->first('destino_id'))
											<span class="label label-warning">{{ $errors->first('destino_id') }}</span>
											@endif
											{{ Form::hidden('destino_id' , '0', array('id' =>'destino_id')) }}
										</div>

										<div class="col-md-4">
											<label>Tipos Carga</label>
											{{ Form::select( 'tiposcargas_id', TiposCarga::All()->
											lists('tiposcarga', 'id'), Input::get('tiposcarga'), array( "placeholder" => "", 'class' => 'form-control input-lg')) }}
										</div>

								</div>

								<br>


								<div class="row">
										<div class="col-md-4">
											<label>Fecha de transporte</label>
											{{ Form::text('fecha', '', ['id' =>  'fecha', 'placeholder' =>  '', 'class' => 'form-control input-lg'])}}
											@if ($errors->first('fecha'))
											<span class="label label-warning">{{ $errors->first('fecha') }}</span>
											@endif

										</div>
										<div class="col-md-4">
											<label>Kilos aproximados</label>
											{{ Form::text('kilos', '', ['id' =>  'kilos', 'placeholder' =>  '', 'class' => 'form-control input-lg'])}}
											@if ($errors->first('kilos'))
											<span class="label label-warning">{{ $errors->first('kilos') }}</span>
											@endif
										</div>
										<div class="col-md-4">
											<label>Importe ofrecido</label>
											{{ Form::text('importe', '', ['id' =>  'importe', 'placeholder' =>  '', 'class' => 'form-control input-lg'])}}
											@if ($errors->first('importe'))
											<span class="label label-warning">{{ $errors->first('importe') }}</span>
											@endif
										</div>

								</div>


								<br><br>


								<div class="row">
									<div class="col-md-12">
										<input type="submit" value="Grabar" class="btn btn-primary btn-lg" data-loading-text="Loading...">
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6">

						</div>

					</div>

				</div>

			</div>


			<script type="text/javascript">



						//Javascript
						$(function()
						{

							$( "#fecha" ).datepicker();
							$( "#fecha" ).datepicker({ dateFormat: 'dd-mm-yy' });
							$( "#fecha" ).datepicker( "option", "dateFormat", "dd/mm/yy" );


							$( "#origen" ).autocomplete({
								source: "/search/ciudads",
								minLength: 3,
								select: function(event, ui) {
									$('#origen').val(ui.item.value);
									$('#origen_id' ).val( ui.item.id );
								}
							});

							$( "#destino" ).autocomplete({
								source: "/search/ciudads",
								minLength: 3,
								select: function(event, ui) {
									$('#destino').val(ui.item.value);
									$('#destino_id' ).val( ui.item.id );
								}
							});



						});



			</script>


			@stop

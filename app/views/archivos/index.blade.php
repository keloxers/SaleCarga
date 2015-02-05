@extends('layouts.default')

@section('content')

<div class="container">

	<h1>Archivos</h1>
	<h3>Producto: </h3><b>{{$producto->producto}}</b>
	<br><br>


	<div class="row">
		<div class="col-md-6">


			{{ Form::open(array('route' => 'archivos.store', 'files' => true, 'class'=>'panel-body wrapper-lg', 'enctype' => 'multipart/form-data')) }}
			{{ Form::hidden('padre_id' , $padre_id, array('id' =>'padre_id')) }}
			{{ Form::hidden('padre' , $padre, array('id' =>'padre')) }}

			<div class="row">
				<div class="form-group">
					<div class="col-md-6">
						<label>Archivo</label>
							<input name="file" type="file"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<div class="col-md-12">
						<label>Descripcion *</label>
						<textarea maxlength="2000" data-msg-required="Please enter your message." rows="10" class="form-control" name="descripcion" id="descripcion"></textarea>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-12">
					<input type="submit" value="Subir" class="btn btn-primary btn-lg" data-loading-text="Loading...">
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">




		<?php if (count($archivos)>0 )  { ?>
			<section class="panel panel-default">

				<div class="table-responsive">
					<table class="table table-striped b-t b-light text-sm">
						<thead>

							<tr>
								<th>Archivo</th>
								<th>Descipcion</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach ($archivos as $archivo) {

								echo "<tr>";
								echo "<td>" . $archivo->archivo . "</td>";
								echo "<td>" . $archivo->descripcion . "</td>";
								echo "<td>" ;

								echo "<a href='/archivos/" . $archivo->id . "/delete' class='btn btn-xs'>Eliminar</a> ";

								print "</td>";
								print "</tr>";

							} ?>

						</tbody>
					</table>
				</div>

			</section>

			<?php } ?>
			

	</div>




	</div>

</div>

</div>


@stop

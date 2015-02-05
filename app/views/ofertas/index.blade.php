@extends('layouts.default')

@section('content')



<div class="container">

	<div class="row">
		<div class="col-md-12">


			<h1>
				Tus Ofertas publicadas
			</h1>

	<?php



		// echo "<a href='/ofertas/create' class='btn btn-primary btn-lg'>Nuevo oferta</a>";

		if (count($ofertas)>0 )  {


?>







		<?php

			}

		?>






		<div role="main" class="main shop">

			<div class="container">

				<hr class="tall">

				<div class="row">
					<div class="col-md-12">







						<div class="row featured-boxes">
							<div class="col-md-12">
								<div class="featured-box featured-box-secundary featured-box-cart">
									<div class="box-content">
										<form method="post" action="">
											<table cellspacing="0" class="shop_table cart">
												<thead>
													<tr>
														<th class="product-remove">
															&nbsp;
														</th>
														<th class="product-name">
															Origen
														</th>
														<th class="product-name">
															Destino
														</th>
														<th class="product-price">
															Tipo de carga
														</th>
														<th class="product-price">
															Importe
														</th>
														<th class="product-subtotal">
															Estado
														</th>
														<th class="product-subtotal">
															Accion
														</th>
													</tr>
												</thead>
												<tbody>






													@foreach ($ofertas as $oferta)

													<?php
													$tiposcarga = Tiposcarga::find($oferta->tiposcargas_id);
													$origen = Ciudad::find($oferta->origen_id);
													$destino = Ciudad::find($oferta->destino_id);

													$provincia_origen = Provincia::find($origen->provincias_id)->provincia;
													$provincia_destino = Provincia::find($destino->provincias_id)->provincia;


														?>

														<tr class="cart_table_item">
																<td>
																	<a title="Remove this item" class="remove" href="/ofertas/{{$oferta->id}}/delete">
																		<i class="icon icon-times"></i>
																	</a>
																</td>
																<td>
																	{{$origen->ciudad}}, {{$provincia_origen}}
																</td>
																<td>
																	{{$destino->ciudad}}, {{$provincia_destino}}
																</td>
																<td>
																	{{$tiposcarga->tiposcarga}}
																</td>

																<td>
																	$ {{$oferta->importe}}
																</td>
																<td>
																	{{$oferta->estado}}
																</td>
																<td class="product-quantity">
																	@if ($oferta->estado=="oferta")
																	<a href="/ofertas/{{$oferta->id}}/contratado"><span class="label label-warning">Contratado</span></a>
																	@else
																	<a href="/ofertas/{{$oferta->id}}/ofertar"><span class="label label-success">Ofertar</span></a>
																	@endif
																</td>
														</tr>


														@endforeach


												</tbody>
											</table>
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
</div>











@stop

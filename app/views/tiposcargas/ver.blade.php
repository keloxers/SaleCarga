@extends('layouts.default')

@section('content')



<div class="container">

	<div class="row">
		<div class="col-md-12">


			<h1>
				Categorias
			</h1>

	<?php



		echo "<a href='/categorias/create' class='btn btn-primary btn-lg'>Nuevo categoria</a>";

		if (count($categorias)>0 )  {


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
															categoria
														</th>
														<th class="product-subtotal">
															Accion
														</th>
													</tr>
												</thead>
												<tbody>






													@foreach ($categorias as $categoria)

														<tr class="cart_table_item">
																<td>
																	<a title="Remove this item" class="remove" href="/categorias/{{$categoria->id}}/delete">
																		<i class="icon icon-times"></i>
																	</a>
																</td>
																<td>
																	{{$categoria->categoria}}
																</td>

																<td class="product-quantity">


																	<a href="/categorias/{{$categoria->id}}/edit"><span class="label label-primary">Editar</span></a>
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


						{{ $categorias->links()}}



					</div>
				</div>

			</div>

		</div>

	</div>
</div>
</div>











@stop

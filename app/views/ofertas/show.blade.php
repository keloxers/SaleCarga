@extends('layouts.default')

@section('content')


<?php
		$origen = Ciudad::find($oferta->origen_id);
		$destino = Ciudad::find($oferta->destino_id);

		$provincia_origen = Provincia::find($origen->provincias_id);
		$provincia_destino = Provincia::find($destino->provincias_id);

		$tiposcarga = TiposCarga::find($oferta->tiposcargas_id)->tiposcarga;

?>

<div role="main" class="main shop">

	<div class="container">


		<div class="row">
			<div class="col-md-9">

				<div class="row">
					<div class="col-md-6">

						<div class="summary entry-summary">

							<span class="posted_in">Tipo de Carga: </span>
							<h2 class="shorter"><strong>{{$tiposcarga}}</strong></h2>

							<span class="posted_in">Desde: </span>
							<h2 class="shorter"><strong>{{$origen->ciudad}}, {{$provincia_origen->provincia}}</strong></h2>

							<span class="posted_in">Hasta: </span>
							<h2 class="shorter"><strong>{{$destino->ciudad}}, {{$provincia_destino->provincia}}</strong></h2>

							<span class="posted_in">Importe: </span>
							<h2 class="shorter"><strong>$ {{$oferta->importe}}</strong></h2>

							<br><br>
							<h2 class="short word-rotator-title">
																Obtene esta carga:
																<strong>
																	<span class="word-rotate">
																		<span class="word-rotate-items">
																			<span>Email: {{$user->email}}</span>
																			<span>Telefono: {{$user->telefono}}</span>
																		</span>
																	</span>
																</strong>
																esperamos tu llamado.
															</h2>


						</div>




					</div>
				</div>



				<hr class="tall" />

				<div class="row">

					<div class="col-md-12">
						<h2>Ofertas <strong>Relacionados</strong></h2>
					</div>

					<ul class="products product-thumb-info-list">


						@if (count($ofertasrelacionadas) )

								@foreach ($ofertasrelacionadas as $ofertasrelacionada)


								<?php
										$origen = Ciudad::find($ofertasrelacionada->origen_id);
										$destino = Ciudad::find($ofertasrelacionada->destino_id);

										$provincia_origen = Provincia::find($origen->provincias_id);
										$provincia_destino = Provincia::find($destino->provincias_id);

										$tiposcarga = TiposCarga::find($ofertasrelacionada->tiposcargas_id)->tiposcarga;

									?>




								<li class="col-md-3 product">
									@if ($ofertasrelacionada->importe > 0 )
									<a href="shop-product-sidebar.html">
										<span class="onsale">Hoy</span>
									</a>
									@endif
									<span class="product-thumb-info">
										<a href="" class="add-to-cart-product">
											<span>Consultar</span>
										</a>
										<a href="/ofertas/show/{{$ofertasrelacionada->url_seo}}">
											<span class="product-thumb-info-image">
												<span class="product-thumb-info-act">
													<span class="product-thumb-info-act-left"><em>Ver</em></span>
													<span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Detalles</em></span>
												</span>
											</span>
										</a>
										<span class="product-thumb-info-content">
											<a href="/ofertas/show/{{ $oferta->url_seo }}">
												<h4>de {{$origen->ciudad}}</h4>
												<h4>a {{$destino->ciudad}}</h4>
												<br>
												<span class="price">
													<ins><span class="amount">$ {{$ofertasrelacionada->importe}}</span></ins>
												</span>
											</a>
										</span>
									</span>
								</li>

								@endforeach

						@endif
					</ul>
				</div>

				<div class="row">
					<div class="col-md-12">
								<div class="tab-pane" id="productReviews">

									<div id="fb-root"></div>
									<script>(function(d, s, id) {
										var js, fjs = d.getElementsByTagName(s)[0];
										if (d.getElementById(id)) return;
										js = d.createElement(s); js.id = id;
										js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=346473362190835&version=v2.0";
										fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));</script>

									<div class="fb-comments" data-href="http://www.salecarga.com/ofertas/{{$oferta->url_seo}}" data-width="800" data-colorscheme="light"></div>


								</div>
							</div>
				</div>


			</div>
			<div class="col-md-3">
				<aside class="sidebar">

					<form>
						<div class="input-group">
							<input class="form-control" placeholder="Search Products..." name="s" id="s" type="text">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary btn-lg"><i class="icon icon-search"></i></button>
							</span>
						</div>
					</form>

					<hr />

					<h5>Tipos de carga</h5>

					<?php
									$tiposcargas = DB::table('tiposcargas')
									->orderby('tiposcarga', "asc")
									->get();
					?>

					@if (count($tiposcargas)>0 )

					@foreach ($tiposcargas as $tiposcarga)
							<a href="/tiposcargas/{{$tiposcarga->tiposcarga}}"><span class="label label-dark">{{$tiposcarga->tiposcarga}}</span></a>
					@endforeach

					@else
							No hay tiposcargas cargadas
					@endif

					<hr />


					<h5>Quizas te interesen estas cargas</h5>
					<ul class="simple-post-list">





							@if (count($ofertas_mas_vistas)>0 )

							@foreach ($ofertas_mas_vistas as $ofertas_mas_vista)

							<?php
									$tiposcarga = Tiposcarga::find($ofertas_mas_vista->tiposcargas_id);
									$origen = Ciudad::find($ofertas_mas_vista->origen_id);
									$destino = Ciudad::find($ofertas_mas_vista->destino_id);
									$provincia_origen = Provincia::find($origen->provincias_id)->provincia;
									$provincia_destino = Provincia::find($destino->provincias_id)->provincia;
							?>


								<li>
									<div class="post-info">
										<a href="/ofertas/show/{{ $ofertas_mas_vista->url_seo }}">De {{$origen->ciudad}} , {{$provincia_origen}} A {{$destino->ciudad}}, {{$provincia_destino}} </a>
										<div class="post-meta">
											Transporte: {{ $tiposcarga->tiposcarga }}
										</div>
										<div class="post-meta">
											${{ $ofertas_mas_vista->importe }}
										</div>
									</div>
								</li>

							@endforeach

							@endif



					</ul>

				</aside>
			</div>
		</div>
	</div>

</div>








@stop

@extends('layouts.default')
@section('content')



<div role="main" class="main shop">

	<div class="container">

		<div class="row">
			<div class="col-md-9">

				<div class="row">
					<div class="col-md-12">
						<h2 class="shorter"><strong>Cargas disponibles ahora !</strong></h2>
						<p>Aprovecha los mejores viajes !</p>
					</div>
				</div>

				<div class="row">

					<ul class="products product-thumb-info-list">






						@if (count($ofertas)>0 )


						@foreach ($ofertas as $oferta)
						<?php
						$tiposcarga = Tiposcarga::find($oferta->tiposcargas_id);
						$origen = Ciudad::find($oferta->origen_id);
						$destino = Ciudad::find($oferta->destino_id);

						$provincia_origen = Provincia::find($origen->provincias_id)->provincia;
						$provincia_destino = Provincia::find($destino->provincias_id)->provincia;


						?>



						<li class="col-md-3 product">
							@if($oferta->estado=="oferta")
							<a href="/ofertas/show/{{ $oferta->url_seo }}">
								<span class="onsale">Hoy</span>
							</a>
							@endif
							<span class="product-thumb-info">
								<a href="/ofertas/show/{{ $oferta->url_seo }}" class="add-to-cart-product">
									<span> Ver</span>
								</a>
								<a href="/ofertas/show/{{ $oferta->url_seo }}">
									<span class="product-thumb-info-image">
										<span class="product-thumb-info-act">
											<span class="product-thumb-info-act-left"><em>Ver</em></span>
											<span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Detalles</em></span>
										</span>
									</span>
								</a>
								<span class="product-thumb-info-content">
									<a href="/ofertas/show/{{ $oferta->url_seo }}">
										<h6>Origen</h6>
										<h5>{{$origen->ciudad . ", " . $provincia_origen}}</h5>
										<h6>Destino</h6>
										<h5>{{$destino->ciudad . ", " . $provincia_destino}}</h5>

										<span class="price">
											@if($oferta->estado=="contratado")
												<del><span class="amount">Oferta</span></del>
											@endif
											<ins><span class="amount">$ {{$oferta->importe}}</span></ins>

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
					<div class="col-md-12 pull-right">
						@if (count($ofertas)>0 )
							{{ $ofertas->links()}}
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<aside class="sidebar">
					<p><a class="btn btn-primary push-bottom btn-lg" href="/ofertas/create">Agregar Oferta</a></p>
					<hr />
					<form>
						<div class="input-group">
							<input class="form-control" placeholder="Buscar oferta..." name="s" id="s" type="text">
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
							<a href="/ofertas/tiposcargas/{{$tiposcarga->tiposcarga}}"><span class="label label-dark">{{$tiposcarga->tiposcarga}}</span></a>
					@endforeach

					@else
							No hay tiposcargas cargadas
					@endif

					<hr />

					<h5>Ofertas mas vistas</h5>
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

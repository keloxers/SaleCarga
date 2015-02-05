@extends('layouts.default')
@section('content')



<div role="main" class="main shop">

	<div class="container">

		<div class="row">
			<div class="col-md-9">

				<div class="row">
					<div class="col-md-12">
						<h2 class="shorter"><strong>{{$categoria->categoria}}</strong></h2>
						<p>Aprovecha los mejores precios</p>
					</div>
				</div>

				<div class="row">

					<ul class="products product-thumb-info-list">

						@foreach ($productos as $producto)
						<?php
						$archivos = DB::table('archivos')
						->where('padre', '=', 'producto')
						->where('padre_id', '=', $producto->id)
						->first();
						$categoria = Categoria::find($producto->categorias_id);
						?>



						<li class="col-md-3 product">
							@if($producto->precio_anterior>0)
							<a href="shop-product-sidebar.html">
								<span class="onsale">Desc</span>
							</a>
							@endif
							<span class="product-thumb-info">
								<a href="shop-cart.html" class="add-to-cart-product">
									<span><i class="icon icon-shopping-cart"></i> Agregar a Carrito</span>
								</a>
								<a href="/productos/show/{{ $producto->url_seo }}">
									<span class="product-thumb-info-image">
										<span class="product-thumb-info-act">
											<span class="product-thumb-info-act-left"><em>Ver</em></span>
											<span class="product-thumb-info-act-right"><em><i class="icon icon-plus"></i> Detalles</em></span>
										</span>
										@if (count($archivos)>0 )
										<img alt="" class="img-responsive" src="/uploads/big/{{ $archivos->archivo }}">
										@endif
									</span>
								</a>
								<span class="product-thumb-info-content">
									<a href="/productos/show/{{ $producto->url_seo }}">
										<h4>{{$producto->producto}}</h4>
										<span class="price">
											@if($producto->precio_anterior>0)
											<del><span class="amount">$ {{$producto->precio_anterior}}</span></del>
											@endif
											<ins><span class="amount">$ {{$producto->precio_publico}}</span></ins>

										</span>
									</a>
								</span>
							</span>
						</li>


						@endforeach



					</ul>

				</div>

				<div class="row">
					<div class="col-md-12">
						<ul class="pagination pull-right">
							<li><a href="#"><i class="icon icon-chevron-left"></i></a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#"><i class="icon icon-chevron-right"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<aside class="sidebar">

					<form>
						<div class="input-group">
							<input class="form-control" placeholder="Buscar producto..." name="s" id="s" type="text">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary btn-lg"><i class="icon icon-search"></i></button>
							</span>
						</div>
					</form>

					<hr />

					<h5>Categorias</h5>

					<?php

					$categorias = DB::table('categorias')
					->orderby('categoria', "asc")
					->get();



					?>

					@if (count($categorias)>0 )

					@foreach ($categorias as $categoria)
					<a href="/categorias/productos/{{$categoria->categoria}}"><span class="label label-dark">{{$categoria->categoria}}</span></a>
					@endforeach

					@elseif
					No hay categorias cargadas
					@endif

					<hr />

					<h5>Productos mas Vendidos</h5>
					<ul class="simple-post-list">
						<li>
							<div class="post-image">
								<div class="img-thumbnail">
									<a href="shop-product-sidebar.html">
										<img alt="" width="60" height="60" class="img-responsive" src="img/products/product-1.jpg">
									</a>
								</div>
							</div>
							<div class="post-info">
								<a href="shop-product-sidebar.html">Photo Camera</a>
								<div class="post-meta">
									$299
								</div>
							</div>
						</li>

					</ul>

				</aside>
			</div>
		</div>
	</div>

</div>





@stop

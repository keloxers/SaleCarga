<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<head>

	<!-- Basic -->
	<meta charset="utf-8">
	<title>{{trans('app.site')}}</title>
	<meta name="keywords" content="{{trans('app.keywords')}}" />
	<meta name="description" content="{{trans('app.description')}}">
	<meta name="author" content="{{trans('app.author')}}">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Libs CSS -->
	<link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="/css/fonts/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="/vendor/owl-carousel/owl.carousel.css" media="screen">
	<link rel="stylesheet" href="/vendor/owl-carousel/owl.theme.css" media="screen">
	<link rel="stylesheet" href="/vendor/magnific-popup/magnific-popup.css" media="screen">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="/css/theme.css">
	<link rel="stylesheet" href="/css/theme-elements.css">
	<link rel="stylesheet" href="/css/theme-animate.css">
	<link rel="stylesheet" href="/css/theme-shop.css">

	<!-- Skin CSS -->
	<link rel="stylesheet" href="/css/skins/blue.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="/css/custom.css">

	<!-- Responsive CSS -->
	<link rel="stylesheet" href="/css/theme-responsive.css" />

	<!-- Head Libs -->
	<script src="/vendor/modernizr.js"></script>

	<script src="/scripts/external/jquery/jquery.js"></script>

	<!--[if IE]>
	<link rel="stylesheet" href="/css/ie.css">
	<![endif]-->

	<!--[if lte IE 8]>
	<script src="/vendor/respond.js"></script>
	<![endif]-->

</head>
<body>

	<div class="body">
		<header>
			<div class="container">
				<h1 class="logo">
					<a href="/">
						<img alt="Porto" width="111" height="54" data-sticky-width="82" data-sticky-height="40" src="/img/logo.png">
					</a>
				</h1>
				<div class="search">
					<form id="searchForm" action="page-search-results.html" method="get">
						<div class="input-group">
							<input type="text" class="form-control search" name="q" id="q" placeholder="Buscar...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="icon icon-search"></i></button>
							</span>
						</div>
					</form>
				</div>
				<div class="social-icons">
					<ul class="social-icons">
						<li class="facebook"><a href="{{trans('app.seguinos_facebook')}}" target="_blank" title="Facebook">Facebook</a></li>
						<li class="twitter"><a href="{{trans('app.seguinos_twitter')}}" target="_blank" title="Twitter">Twitter</a></li>
						<li class="googleplus"><a href="{{trans('app.seguinos_googleplus')}}" target="_blank" title="Linkedin">Linkedin</a></li>
						<li class="linkedin"><a href="{{trans('app.seguinos_linkedin')}}" target="_blank" title="Linkedin">Linkedin</a></li>
						<li class="instagram"><a href="{{trans('app.seguinos_instagram')}}" target="_blank" title="Linkedin">Instagram</a></li>
						<li class="youtube"><a href="{{trans('app.seguinos_youtube')}}" target="_blank" title="Linkedin">youtube</a></li>
					</ul>
				</div>
				<nav>
					<ul class="nav nav-pills nav-top">
						<li>
							<a href="contact-us.html"><i class="icon icon-angle-right"></i>Contactarse</a>
						</li>
						<li class="phone">
							<span><i class="icon icon-phone"></i>{{trans('app.telefono')}}</span>
						</li>
					</ul>
				</nav>
				<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
					<i class="icon icon-bars"></i>
				</button>
			</div>
			<div class="navbar-collapse nav-main-collapse collapse">
				<div class="container">
					<nav class="nav-main mega-menu">
						<ul class="nav nav-pills nav-main" id="mainMenu">

							<li>
								<a href="/">Home</a>
							</li>



							<?php
												$pages = DB::table('pages')
													->where('activo', '=', 'si')
													->where('padre', '=', 'main')
													->where('mostrar_menu', '=', 'si')
													->orderBy('page', 'asc')->get();
												if (count($pages)) {
														foreach ($pages as $page) {
															?>
														<li><a href="/pages/{{$page->url_seo}}"><span>{{$page->page}}</span></a></li>
															<?php
													}
												}

							?>


							@if (Sentry::check())

									<li class="dropdown">
										<a class="dropdown-toggle" href="{{ URL::to('users') }}/{{ Session::get('userId') }}">
											{{Session::get('email')}}
											<i class="icon icon-angle-down"></i>
										</a>
										<ul class="dropdown-menu">


											@if (Sentry::check() && Sentry::getUser()->hasAccess('users'))

													@if (Sentry::getUser()->hasAccess('admin'))
													<li><a href="/banners"><span>Banners</span></a></li>
													<li><a href="/contactos"><span>Contactos</span></a></li>
													<li><a href="/pages"><span>Paginas</span></a></li>
													<li><a href="/tiposcargas"><span>Tipos Cargas</span></a></li>
													<li><a href="{{ URL::to('/users') }}"><span>{{trans('pages.users')}}</span></a></li>
													<li><a href="{{ URL::to('/groups') }}"><span>{{trans('pages.groups')}}</span></a></li>
													@endif
													<li><a href="{{ URL::to('users') }}/{{ Session::get('userId') }}"><span>Perfil</span></a></li>													
													<li><a href="/ofertas"><span>Ofertas</span></a></li>







											@endif




											<li><a href="/logout">Logout</a></li>
										</ul>
									</li>

							@else
									<li> <a href="/login">Login</a> </li>
							@endif









						</ul>
					</nav>
				</div>
			</div>
		</header>

		<div role="main" class="main shop">

			<div class="container">

				<hr class="tall">


						@yield('content')

				<hr class="tall">

			</div>

		</div>

		<footer>
			<div class="container">
				<div class="row">
					<div class="footer-ribon">
						<span>Contactarse</span>
					</div>
					<div class="col-md-4">
						<div class="newsletter">
							<h4>Boletin informativo</h4>
							<p>Manténgase informado de nuestras características del producto siempre en evolución. Ingrese su dirección de e-mail y suscríbete a nuestro boletín.</p>
							<form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST">
								<div class="input-group">
									<input class="form-control" placeholder="Email Address" name="email" id="email" type="text">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit">Suscribirse!</button>
									</span>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-4">
						<div class="contact-details">
							<h4>Póngase en contacto</h4>
							<ul class="contact">
								<li><p><i class="icon icon-map-marker"></i> <strong>Direccion:</strong> {{trans('app.direccion')}}</p></li>
								<li><p><i class="icon icon-phone"></i> <strong>Telefono:</strong> {{trans('app.telefono')}}</p></li>
								<li><p><i class="icon icon-envelope"></i> <strong>Email:</strong> {{trans('app.email')}}</p></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<h4>Siguenos en</h4>
						<div class="social-icons">
							<ul class="social-icons">
								<li class="facebook"><a href="{{trans('app.seguinos_facebook')}}" target="_blank" data-placement="bottom" rel="tooltip" title="Facebook">Facebook</a></li>
								<li class="twitter"><a href="{{trans('app.seguinos_twitter')}}" target="_blank" data-placement="bottom" rel="tooltip" title="Twitter">Twitter</a></li>
								<li class="googleplus"><a href="{{trans('app.seguinos_googleplus')}}" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">Linkedin</a></li>
								<li class="linkedin"><a href="{{trans('app.seguinos_linkedin')}}" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">Linkedin</a></li>
								<li class="instagram"><a href="{{trans('app.seguinos_instagram')}}" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">Instagram</a></li>
								<li class="youtube"><a href="{{trans('app.seguinos_youtube')}}" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">youtube</a></li>

							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-1">
							<a href="/" class="logo">
								<img alt="Porto Website Template" class="img-responsive" src="/img/logo-footer.png">
							</a>
						</div>
						<div class="col-md-7">
							<p>© Copyright 2014 Codex-SA.com All Rights Reserved.</p>
						</div>
						<div class="col-md-4">
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<!-- Libs
	<script src="/vendor/jquery.js"></script> -->

	<script src="/js/plugins.js"></script>
	<script src="/vendor/jquery.easing.js"></script>
	<script src="/vendor/jquery.appear.js"></script>
	<script src="/vendor/jquery.cookie.js"></script>

	<script src="/vendor/bootstrap.js"></script>
	<script src="/vendor/twitterjs/twitter.js"></script>
	<script src="/vendor/owl-carousel/owl.carousel.js"></script>
	<script src="/vendor/jflickrfeed/jflickrfeed.js"></script>
	<script src="/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="/vendor/jquery.validate.js"></script>

	<!-- Theme Initializer -->
	<script src="/js/theme.js"></script>

	<!-- Custom JS -->
	<script src="/js/custom.js"></script>



</body>
</html>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title') | {{ getSiteName() }}</title>

	<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/all.min.css') }}">

	<link rel="icon" href="{{ getSiteLogo() }}">

	@yield('custom_head')
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
		<div class="container">
			<a class="navbar-brand" href="{{ route('home') }}">
				<img class="logo" src="{{ getSiteLogo() }}" height="40">
			</a>
			<button class="navbar-toggler" type="button"
				data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false"
				aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar1">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item ml-2 active"><a class="nav-link" href="{{ route('home') }}">
						Beranda
						<span
							class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item ml-2">
						<a class="nav-link" href="{{ route('relation.index') }}">Sanggar</a>
					</li>
					<li class="nav-item ml-2 dropdown"><a class="nav-link dropdown-toggle" href="javascript:;"
							data-toggle="dropdown">Edukasi</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('edu.videos.index') }}" class="dropdown-item">Video</a>
								<a href="{{ route('edu.photos.index') }}" class="dropdown-item">Foto</a>
								<a href="{{ route('edu.articles.index') }}" class="dropdown-item">Artikel</a>
							</li>
						</ul>
					</li>
					<li class="nav-item ml-2">
						<a class="nav-link" href="{{ route('donation.index') }}">Donasi</a>
					</li>
					<li class="nav-item ml-2">
						<a class="nav-link" href="">Tentang {{ getSiteName() }}</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<footer class="bg-white">
		<a href="#" id="c-go-top" class="c-go-top"><i class="fa fa-arrow-up fa-fw"></i></a>
		<div class="footer p-3">
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<ul class="d-md-block d-lg-inline-block list-inline text-center text-lg-left">
							<li class="d-block d-lg-inline-block list-inline-item mr-3"> <a
									href="{{ route('home') }}">Beranda</a></li>
							<li class="d-block d-lg-inline-block list-inline-item mr-3"> <a
									href="{{ route('pages', 'about') }}">Tentang Kami</a></li>
							<li class="d-block d-lg-inline-block list-inline-item mr-3"> <a
									href="{{ route('pages', 'contact') }}">Hubungi Kami</a></li>
						</ul>
					</div>
					@if (count(getSocialLinks()) > 0)
					<div class="col-sm-5">
						<ul
							class="social-list d-md-block d-lg-inline-block text-lg-right text-center list-inline w-100">
							@foreach (getSocialLinks() as $social)
							<li class="list-inline-item mr-3">
								<a href="{{ $social->link }}" title="{{ $social->title }}"><i class="{{ $social->fa_icon }}"></i></a>
							</li>
							@endforeach
						</ul>
					</div>
					@endif
				</div>
				<div class="row footer-credit">
					<div class="col-sm-7">&copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ getSiteName() }}</a>. All right reserved.</div>
					<div class="col-sm-5 text-center text-md-right">
						<a
							href="https://kbkm.kebudayaan.id/" target="_blank" rel="nofollow">Kemah Budaya Kaum Muda 2020</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script src="{{ asset('assets/plugins/jquery/jquery-2.2.3.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/themes/public/js/slick.min.js') }}"></script>
	<script src="{{ asset('assets/themes/public/js/lightbox.js') }}"></script>

	<script>
        $(function () {
            var offset = 100;
            var duration = 500;
            $(window).scroll(function () {
                if ($(this).scrollTop() > offset) {
                    $('#c-go-top').fadeIn(duration)
                } else {
                    $('#c-go-top').fadeOut(duration)
                }
            });
            $('#c-go-top').click(function (event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, duration);
                return !1
            })
        });
	</script>

	@stack('custom_js')
</body>

</html>
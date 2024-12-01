
@if (!isset(Auth::user()->id))
	return redirect('/login')
@endif

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<title>@yield('page_title','Admin Dashboard')</title>
    <link rel="icon" href="{{asset('contents/admin')}}/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{asset('contents/admin')}}/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{asset('contents/admin')}}/assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<link rel="stylesheet" href="{{ asset('contents/admin') }}/assets/css/cropper.min.css">

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/azzara.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/demo.css">
	<link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/style.css">
	<script src="{{asset('contents/admin')}}/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="{{asset('contents/admin')}}/assets/js/sweetalert.min.js"></script>
</head>
<body>
	<div class="wrapper">
		<!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
        @include('admin.main_header')
		

		<!-- Sidebar -->
        @include('admin.sidebar')
		
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">
							@yield('page-heading')
						</h4>
					</div>
                    {{-- add dashboard/index.blade.php file here --}}
					@yield('content')
				</div>
			</div>
			
		</div>
		
	</div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>
<!--   Core JS Files   -->
<script src="{{asset('contents/admin')}}/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/core/popper.min.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Moment JS -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/moment/moment.min.js"></script>

<!-- Chart JS -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Bootstrap Toggle -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Google Maps Plugin -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/gmaps/gmaps.js"></script>

{{-- cropper js for image upload --}}
<script src="{{asset('contents/admin')}}/assets/js/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/cropper.min.js"></script>
<!-- Sweet Alert -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="{{asset('contents/admin')}}/assets/js/ready.min.js"></script>

@yield('script')
</body>
</html> 
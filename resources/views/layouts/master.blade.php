<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:image" content="https:/fillow.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>iBooking |  Admin</title>
	<!-- Daterange picker -->
	<link href="{{asset('assets/admin/vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
	<!-- Clockpicker -->
	<link href="{{asset('assets/admin/vendor/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
	<!-- asColorpicker -->
	<link href="{{asset('assets/admin/vendor/jquery-asColorPicker/css/asColorPicker.min.css')}}" rel="stylesheet">
	<!-- Material color picker -->
	<link href="{{asset('assets/admin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
	<!-- Pick date -->
	<link rel="stylesheet" href="{{asset('assets/admin/vendor/pickadate/themes/default.css')}}">
	<link rel="stylesheet" href="{{asset('assets/admin/vendor/pickadate/themes/default.date.css')}}">
	<link href="../icon.css?family=Material+Icons" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="{{asset('assets/admin/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{asset('assets/admin/images/favicon.png')}}">
	<link href="{{asset('assets/admin/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link href="{{asset('assets/admin/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('assets/admin/vendor/nouislider/nouislider.min.css')}}">
	
	<!-- Style css -->
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">

	
	
</head>
<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
		<div class="nav-header">
            <a href="{{route('admin.dashboard')}}" class="brand-logo">
				<svg class="logo-abbr" width="55" height="55" viewbox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M27.5 0C12.3122 0 0 12.3122 0 27.5C0 42.6878 12.3122 55 27.5 55C42.6878 55 55 42.6878 55 27.5C55 12.3122 42.6878 0 27.5 0ZM28.0092 46H19L19.0001 34.9784L19 27.5803V24.4779C19 14.3752 24.0922 10 35.3733 10V17.5571C29.8894 17.5571 28.0092 19.4663 28.0092 24.4779V27.5803H36V34.9784H28.0092V46Z" fill="url(#paint0_linear)"></path>
					<defs>
					</defs>
				</svg>
				<div class="brand-title">
					<h2 class="">iBooking</h2>
					<span class="brand-sub-title">Booking Ticket</span>
				</div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
     
        {{-- Navigation --}}
        @include('layouts.nav');

        {{-- Side Bar --}}
        @include('layouts.sidebar');

        {{-- Body --}}
        @yield('content')

        {{-- Footer --}}
        @include('layouts.footer')
        

	</div>
    
    <!-- Required vendors -->
    <script src="{{asset('assets/admin/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
	
	<!-- Apex Chart -->
	<script src="{{asset('assets/admin/vendor/apexchart/apexchart.js')}}"></script>
	
	<script src="{{asset('assets/admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	
	<!-- Chart piety plugin files -->
    <script src="{{asset('assets/admin/vendor/peity/jquery.peity.min.js')}}"></script>
	<!-- Dashboard 1 -->
	<script src="{{asset('assets/admin/js/dashboard/dashboard-1.js')}}"></script>
	
	<script src="{{asset('assets/admin/vendor/owl-carousel/owl.carousel.js')}}"></script>

	<!-- Daterangepicker -->
    <!-- momment js is must -->
    <script src="{{asset('assets/admin/vendor/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- clockpicker -->
    <script src="{{asset('assets/admin/vendor/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
    <!-- asColorPicker -->
    <script src="{{asset('assets/admin/vendor/jquery-asColor/jquery-asColor.min.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/jquery-asGradient/jquery-asGradient.min.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js')}}"></script>
    <!-- Material color picker -->
    <script src="{{asset('assets/admin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <!-- pickdate -->
    <script src="{{asset('assets/admin/vendor/pickadate/picker.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/pickadate/picker.date.js')}}"></script>



    <!-- Daterangepicker -->
    <script src="{{asset('assets/admin/js/plugins-init/bs-daterange-picker-init.js')}}"></script>
    <!-- Clockpicker init -->
    <script src="{{asset('assets/admin/js/plugins-init/clock-picker-init.js')}}"></script>
    <!-- asColorPicker init -->
    <script src="{{asset('assets/admin/js/plugins-init/jquery-asColorPicker.init.js')}}"></script>
    <!-- Material color picker init -->
    <script src="{{asset('assets/admin/js/plugins-init/material-date-picker-init.js')}}"></script>
    <!-- Pickdate -->
    <script src="{{asset('assets/admin/js/plugins-init/pickadate-init.js')}}"></script>

	<script src="{{asset('assets/admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

	
    <script src="{{asset('assets/admin/js/custom.min.js')}}"></script>
	<script src="{{asset('assets/admin/js/dlabnav-init.js')}}"></script>
	<script src="{{asset('assets/admin/js/demo.js')}}"></script>
    <script src="{{asset('assets/admin/js/styleSwitcher.js')}}"></script>
	<script>
		function cardsCenter()
		{
			/*  testimonial one function by = owl.carousel.js */
			jQuery('.card-slider').owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				//center:true,
				slideSpeed: 3000,
				paginationSpeed: 3000,
				dots: true,
				navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
				responsive:{
					0:{
						items:1
					},
					576:{
						items:1
					},	
					800:{
						items:1
					},			
					991:{
						items:1
					},
					1200:{
						items:1
					},
					1600:{
						items:1
					}
				}
			})
		}
		
		jQuery(window).on('load',function(){
			setTimeout(function(){
				cardsCenter();
			}, 1000); 
		});
		
	</script>
@yield('scripts')
</body>
</html>
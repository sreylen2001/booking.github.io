<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">

		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>iBooking</title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="{{asset('assets/front/css/linearicons.css')}}">
			<link rel="stylesheet" href="{{asset('assets/front/css/font-awesome.min.css')}}">
			<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.css')}}">
			<link rel="stylesheet" href="{{asset('assets/front/css/magnific-popup.css')}}">
			<link rel="stylesheet" href="{{asset('assets/front/css/jquery-ui.css')}}">				
			<link rel="stylesheet" href="{{asset('assets/front/css/nice-select.css')}}">							
			<link rel="stylesheet" href="{{asset('assets/front/css/animate.min.css')}}">
			<link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.css')}}">				
			<link rel="stylesheet" href="{{asset('assets/front/css/main.css')}}">
</head>
<body>	
    <!-- #header -->
    @include('fronts.nav');

    <!-- start banner Area -->
    @include('fronts.homeheader');
    <!-- End banner Area -->

    <!-- Start popular-destination Area -->
    @include('fronts.homepopulation');
    <!-- End popular-destination Area -->

    <!-- Start price Area -->
    @include('fronts.price');
    <!-- End price Area -->
    
    <!-- Start other-issue Area -->
    @include('fronts.issue')
    <!-- End other-issue Area -->

    <!-- Start testimonial Area -->
    @include('fronts.testimonial')
    <!-- End testimonial Area -->

    <!-- Start home-about Area -->
    @include('fronts.homeabout')
    <!-- End home-about Area -->

    <!-- Start blog Area -->
    @include('fronts.blog')
    <!-- End recent-blog Area -->			

    <!-- start footer Area -->		
    @include('fronts.footer')
    <!-- End footer Area -->	

    <script src="{{asset('assets/front/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/front/js/vendor/bootstrap.min.js')}}"></script>			
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>		
     <script src="{{asset('assets/front/js/jquery-ui.js')}}"></script>					
      <script src="{{asset('assets/front/js/easing.min.js')}}"></script>			
    <script src="{{asset('assets/front/js/hoverIntent.js')}}"></script>
    <script src="{{asset('assets/front/js/superfish.min.js')}}"></script>	
    <script src="{{asset('assets/front/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('assets/front/js/jquery.magnific-popup.min.js')}}"></script>						
    <script src="{{asset('assets/front/js/jquery.nice-select.min.js')}}"></script>					
    <script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>							
    <script src="{{asset('assets/front/js/mail-script.js')}}"></script>	
    <script src="{{asset('assets/front/js/main.js')}}"></script>	
</body>
</html>

	
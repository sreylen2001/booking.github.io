<header id="header">
    <div class="header-top">
        <div class="container">
          <div class="row align-items-center">
            @guest
                @if (Route::has('user.login'))
                <div class="col-lg-6 col-sm-6 col-6 header-top-left">
                    @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <ul>
                        <li><a href="{{ route('user.login') }}">Login</a></li>
                        @if (Route::has('user.register'))
                        <li><a href="{{ route('user.register') }}">Register</a></li>
                        @endif
                    </ul>	
                    @endauth
                </div>
                <div class="col-lg-6 col-sm-6 col-6 header-top-right">
                    <div class="header-social">
                        <a href="{{ route('admin.login') }}"><i class="fa fa-user"></i></a>
                        
    
                    </div>
                </div>
                @endif
                @else
                <div class="col-lg-6 col-sm-6 col-6 d-flex header-top-right">
                    <div class="header-social">                        
                        <a href="{{ route('user.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </div>
                </div>
            @endguest
          </div>			  					
        </div>
    </div>
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
          <div id="logo">
            <a href="index.html"><img src="img/logo.png" alt="" title="iBooking" /></a>
          </div>
          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li><a href="{{ route('home') }}">Home</a></li>
              <li><a href="{{ route('about') }}">About</a></li>
              <li><a href="{{ route('bus') }}">Bus</a></li>
              <li><a href="{{ route('hotel') }}">Hotel</a></li>
              <li><a href="{{ route('contact') }}">Contact</a></li>
              
            </ul>
          </nav><!-- #nav-menu-container -->					      		  
        </div>
    </div>
</header><!-- #header -->
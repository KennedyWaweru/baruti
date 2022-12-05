<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="{{asset('images/rocket-logo.svg')}}">

	@yield('meta')
	<title>KenWebshop @yield('title')</title>
	<!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  
  <!-- Your custom styles (optional) -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

 
	@yield('styles')
	@yield('scripts')
  @livewireStyles
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
 

</head>
<body>
  @yield('fb_login_script')
  
  <div class="row">
   @include('partials.nav') 
  </div>
  <section class="main">
    @include('partials.messages')
    @yield('content')


    @livewire('shopping-cart')
  </section>
	<section class="footer-section">
   @include('partials.footer')
  </section>
</body>
 	@yield('bottom_scripts')
  @livewireScripts
  <script src="{{asset('js/cart.js')}}"></script>
</html>
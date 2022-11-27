@extends('layouts.master')

@section('content')
	<div class="page-header text-center">
		<div id="heading-text">
			<div class="p-4 w-100 h-100 rounded-3 border bg-dark">
				{{-- <h1 id="countdown"></h1> --}}
				<div class="d-flex flex-row justify-content-evenly bd-highlight mb-3">
					<div class="p2 countdown">
						<h1 id="countdownDays">

						</h1>
						<small class="text-muted">Day</small>
					</div>
					<div class="p2" id="countdown">
						<h1 id="countdownHours">

						</h1>
						<small class="text-muted">Hour</small>
					</div>
					<div class="p2 bd-highlight" id="countdownMins">
						<h1 id="countdown">

						</h1>
						<small class="text-muted">Min</small>
					</div>
					<div class="p2 bd-highlight" id="countdownSecs">
						<h1 id="countdown">

						</h1>
						<small class="text-muted">Sec</small>
					</div>
				</div>
				<h1>Happy New Year</h1>
			</div>
			
			
			{{-- <a href="#" role="button" class="btn btn-success btn-lg" id="heading-cta">Welcome</a> --}}
		</div>
		
		{{-- <img src="{{asset('images/free-fireworks-banner.jpg')}}" alt="" class="img-fluid" id="heading-image"> --}}
	</div>

	
	<div class="container-fluid">
		<!-- Packages Section -->
		<section class="packages mt-5">
			<div class="row">
				<h2 class="text-center text-white py-2">Packages</h2>
				@isset($packages)
				@foreach($packages as $package)
					@livewire('package-table',['package'=>$package]))
				@endforeach
				@else
				<h1>No Package found</h1>
				@endisset
				
			</div>
		</section>
		<!-- End of packaged section -->

		<hr class="my-4 text-white">

		<!-- Products Section -->

		@livewire('products-table')
		
		<!-- End of Featured Products Section -->

		<!-- Categories Section -->
		<section class="categories">
			<div class="row mt-5 text-center">
				<div class="h2 text-white">Categories</div>
				@isset($categories)
				@foreach($categories as $category)
				<div class="col-sm-6 my-2 h-100">
					<div class="card bg-dark bordered border-primary text-dark">
						{{-- <img src="{{$category->image}}" class="card-img img-fluid" alt="{{$category->name}}" style="height:300px;"> --}}
						<img src="{{env('AWS_BUCKET_URL').$category->image}}" class="card-img img-fluid" alt="{{$category->name}}" style="height:300px;">
						<div class="card-img-overlay">
							<div class="border p-2 bg-info rounded-3">
								<h5 class="card-title">
									<a href="{{route('category.show',$category)}}" role="button" class="btn stretched-link">
										{{$category->name}}
									</a>
								</h5>
							</div>
							
							{{-- <p class="card-text">{{$category->description}}</p> --}}
							<p class="card-text">
								
							</p>
						</div>
					</div>
				</div>
				
				@endforeach
				@else
				<h2 class="text-center">No Category Data</h2>
				@endisset
				
			</div>
		</section>
		<!-- End of Categories -->

		<!-- About our shop and the online shopping experience -->
		<section class="details my-4">
			<div class="row">
				<h2 class="text-center text-white">Shop With Us</h2>
				<div class="col-md-4 my-2">
					<div class="rounded-3 h-100 p-4 border-info bg-light">
						<h2 class="text-center">
							Delivery
						</h2>
						<p class="text-start">
							When you place an order for goods and services on this website, we will request you to provide a delivery address. We will deliver the ordered products to the provided address within the stated timelines. Each delivery is ensured through our delivery partners. 
						</p>
					</div>
				</div>
				<div class="col-md-4 my-2">
					<div class="rounded-3 h-100 p-4 border-info bg-light">
						<h2 class="text-center">
							Payment Process
						</h2>
						<p class="text-start">
							We accept Lipa Na Mpesa option as the preferred method of payment. Once you have selected the products you would like to buy, place an order by filling in your delivery details. Request for payment and enter your mpesa pin. Your delivery will be made within your preferred time.
							{{--
								For Pay on Delivery create an order, do not press the Send Request to Phone button.
							<br>
							 Call +254 724442515 and request for payment on delivery. A convenience fee of Kshs 500 will be charged.
							--}}
							 
						</p>
					</div>
				</div>
				<div class="col-md-4 my-2">
					<div class="rounded-3 h-100 p-4 border-info bg-light">
						<h2 class="text-center">
							About Us
						</h2>
						<p class="text-start">
							We aim to avail quality products and services from credible businesses, farmers, and services providers to consumers wherever they may be starting with Kenya. We will deliver quality products to your address within 24hrs.

							You can reach us on WhatsApp and or call +254 724 442515. Buying made easy for you. Unpack your new shopping experience.  
						</p>
					</div>
				</div>
			</div>
		</section>
		<!-- End of shop details -->
		
		
	</div>

	
@endsection

@section('bottom_scripts')
	<script src="{{asset('js/custom.js')}}"></script>

	<script src="https://cdn.jsdelivr.net/npm/fireworks-js@latest/dist/fireworks.js"></script>
<script>
    const firediv = document.querySelector('.page-header');
    const fireworks = new Fireworks(firediv, {});

    fireworks.start();
</script>
@endsection
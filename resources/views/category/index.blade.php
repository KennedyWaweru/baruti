@extends('layouts.master')
@section('styles')
	
@endsection
@section('content')
<div class="container">
	<!-- Categories Section -->
	<section class="categories">
		<div class="row mt-3 text-center">
			@isset($categories)
			<div class="col-md-4 col-sm-12">
				<nav aria-label="breadcrumb ">
				<ol class="breadcrumb float-start">
					<li class="breadcrumb-item fs-6">
						<span class="badge rounded-pill bg-light text-dark fs-6">
						<a href="{{route('base')}}">Home</a>
						</span>
					</li>
						
					<li class="breadcrumb-item active fs-6" aria-current="page">
						<span class="badge rounded-pill bg-light text-dark fs-6">
						Categories
						</span>
					</li>
				</ol>
			</nav>
			</div>
			<div class="col-md-8 col-sm-12">
				<div class="h2 text-white">Categories</div>
			</div>
		
			@foreach($categories as $category)

			<div class="card mb-3">
				<div class="row g-0">
					<div class="col-md-4">
						{{-- <img src="{{asset($category->image)}}" class="img-fluid rounded-start h-100 d-inline-block" alt="{{$category->name}}"> --}}
						<img src="{{env('AWS_BUCKET_URL').$category->image}}" class="img-fluid rounded-start h-100 d-inline-block" alt="{{$category->name}}">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">{{$category->name}}</h5>
							<p class="card-text">{{$category->description}}</p>
							<a href="{{route('category.show',$category)}}" role="button" class="btn btn-outline-primary stretched-link">View</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach

			@else
			<div class="row mt-5 text-center">
				<div class="h-100 border p-5 bg-light rounded-3">No Categories Yet</div>
			</div>
			@endisset
		</div>
	</section>
	<!-- End of Categories -->
</div>
@endsection
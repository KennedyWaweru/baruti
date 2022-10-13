@extends('layouts.master')

@section('content')
	<div class="container">
		<div class="row">
			@isset($category)
			<div class="row mt-3">
				<div class="col-md-6 col-sm-12">
					<nav aria-label="breadcrumb">
					<ol class="breadcrumb float-start">
						<li class="breadcrumb-item fs-6">
							<span class="badge rounded-pill bg-light text-dark fs-6">
								<a href="{{route('base')}}">Home</a>
							</span>
						</li>
						<li class="breadcrumb-item fs-6">
							<span class="badge rounded-pill bg-light text-dark fs-6">
								<a href="{{route('category')}}">Categories</a>
							</span>
						</li>
						<li class="breadcrumb-item active fs-6" aria-current="page">
							<span class="badge rounded-pill bg-light text-dark fs-6">
								{{$category->name}}
							</span>
						</li>
					</ol>
				</nav>
				</div>
				
			</div>
			

			<div class="card my-3">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="{{asset($category->image)}}" class="img-fluid rounded-start h-100 d-inline-block" alt="{{$category->name}}">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title text-center">{{$category->name}}</h5>
							<p class="card-text">{{$category->description}}</p>
							
						</div>
					</div>
				</div>
			</div>
			@endisset
		</div>
		<hr class="my-3 fs-3 text-info">
		@isset($fireworks)
		@livewire('related-products',['related_products'=>$fireworks])
		@endisset
	</div>
@endsection
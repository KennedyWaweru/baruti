@extends('layouts.master')


@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-sm-12">
			<nav aria-label="breadcrumb ">
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
					<li class="breadcrumb-item fs-6">
						<span class="badge rounded-pill bg-light text-dark fs-6">
							<a href="{{route('category.show',$firework->category)}}">{{$firework->category->name}}</a>
						</span>
					</li>
					<li class="breadcrumb-item active fs-6" aria-current="page">
						<span class="badge rounded-pill bg-light text-dark fs-6">
							{{$firework->name}}
						</span>
					</li>
				</ol>
			</nav>
		</div>
		<div class="col-sm-12">
			<h3 class="text-center text-white">{{$firework->name}}</h3>
		</div>
		
	</div>
</div>
	<div class="container-md show-product">
		<div class="row bg-light rounded-3">
			<div class="col-md-8 col-sm-12">
				{{-- @isset($firework->images)
				<div class="row">
					<div class="col-3">
						@php
							$images_json = json_decode($firework->images);
						@endphp
						<img src="{{asset($firework->image_url)}}" alt="{{$firework->name}}" onclick="showImg(this);" class="img-fluid my-2" id="thumbnail">
						@foreach($images_json as $img)
						<img src="{{asset($img)}}" alt="{{$firework->name}}" onclick="showImg(this);" class="img-fluid my-2" id="thumbnail">
						@endforeach
					</div>
					<div class="col-9">
						<img src="{{asset($firework->image_url)}}" alt="{{$firework->name}}" class="img-fluid" id="expandedImg">
					</div>
				</div>
				@else
					<img src="{{asset('images/ball-bullet-rocket.jpg')}}" alt="" class="img-fluid">
				@endisset
				--}}
				{{--<img src="{{asset('images/ball-bullet-rocket.jpg')}}" alt="" class="img-fluid">--}}
				<img src="{{env(AWS_BUCKET_URL).'/Mars-attack.jpeg'}}" alt="" class="img-fluid">

				
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="card my-2">
					<div class="card-header text-center text-danger">{{$firework->name}}</div>
					<h5 class="card-title text-center text-primary">Kshs {{$firework->price}} /=</h5>
					<div class="card-body">
						<p class="card-text text-start">
							{{$firework->description}}
						</p>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">Colour Effects: &nbsp;
							@isset($firework->effect_colors)
								@php
									$colors_json = json_decode($firework->effect_colors);
								@endphp
								@foreach($colors_json as $color)
									{{$color}} &nbsp;
								@endforeach
							@endisset
						</li>
						<li class="list-group-item">Height (meters): &nbsp; {{$firework->height_altitude}}</li>
						<li class="list-group-item">Items in Packet: &nbsp; {{$firework->number_of_shots}}</li>
					</ul>
					<div class="card-footer">
						
							@livewire('product-page', ['product_id'=>$product_id,'quantity'=>1,'max_stock'=>$firework->stock])
					
					</div>
				</div>
				<!-- End of product Card -->
				@auth
				@can('admin')
				<!-- Edit and Delete Button for admin -->
				<a role="button" href="{{route('fireworks.edit', $firework)}}" class="btn btn-primary float-start mb-3">Edit</a>
				<button role="button" class="btn btn-danger float-end mb-3" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
				@endcan
				@endauth

				<!-- Modal to ensure the user wants to delete the product -->
				<!-- Modal -->
				<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-center" id="deleteModalLabel">Delete {{$firework->name}}</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="alert alert-danger fs-6" role="alert">
									This action will delete <strong>{{$firework->name}}</strong> permanently.
									<br class="my-2">
									Click Delete to remove the record.
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								{{Form::open(['action'=>['FireworkController@destroy',$firework], 'method'=>'POST'])}}
								@method('DELETE')
								{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
								{{Form::close()}}
								
							</div>
						</div>
					</div>
				</div>
				<!-- End of edit and Delete Button section -->
			</div>
		</div>
		
		@isset($firework->video_url)
		<hr class="mb-3">
		<div class="row">
			<h3 class="text-center text-danger">Watch Video</h3>
			<div class="o-video">
				<iframe src="{{$firework->video_url}}" width="100%" height="100%" allowfullscreen></iframe>
			</div>
			
		</div>
		@endisset
		<hr class="mb-3 text-white">
		@isset($related_products)
			@livewire('related-products',['related_products'=>$related_products])
		@endisset
		
	</div>
@endsection

@section('bottom_scripts')
	<script>
		function showImg(img){
			var expandImg = document.getElementById('expandedImg');
			expandImg.src = img.src;
			//console.log(img);
		}
	</script>
@endsection
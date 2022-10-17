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
						{{-- <img src="{{asset($category->image)}}" class="img-fluid rounded-start h-100 d-inline-block" alt="{{$category->name}}"> --}}
						<img src="{{env('AWS_BUCKET_URL').$category->image}}" class="img-fluid rounded-start h-100 d-inline-block" alt="{{$category->name}}">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title text-center">{{$category->name}}</h5>
							<p class="card-text">{{$category->description}}</p>
							
						</div>
					</div>
				</div>
			</div>

			
			@auth
				@can('admin')
				<!-- Edit and Delete Button for admin -->
				<a role="button" href="{{route('category.edit', $category)}}" class="btn btn-primary float-start mb-3">Edit</a>
				<button role="button" class="btn btn-danger float-end mb-3" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
				@endcan
				@endauth

				<!-- Modal to ensure the user wants to delete the product -->
				<!-- Modal -->
				<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-center" id="deleteModalLabel">Delete {{$category->name}}</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="alert alert-danger fs-6" role="alert">
									This action will delete <strong>{{$category->name}}</strong> permanently.
									<br class="my-2">
									Click Delete to remove the record.
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								{{Form::open(['action'=>['CategoryController@destroy',$category], 'method'=>'POST'])}}
								@method('DELETE')
								{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
								{{Form::close()}}
								
							</div>
						</div>
					</div>
				</div>
				<!-- End of edit and Delete Button section -->
			@endisset
		</div>
		<hr class="my-3 fs-3 text-info">
		@isset($fireworks)
		@livewire('related-products',['related_products'=>$fireworks])
		@endisset
	</div>
@endsection
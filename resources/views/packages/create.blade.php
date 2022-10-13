@extends('layouts.master')

@section('content')
	
	<div class="container-fluid">
		<div class="p-5 mb-4 bg-light rounded-3">
			<div class="container-fluid py-5">
				<h1 class="display-5 fw-bold text-center">Upload Package</h1>
				
				{!! Form::open(['action' => 'PackageController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

				<div class="form-group mb-3">
					{{Form::label('name', 'Package Name',['class'=>'form-label'])}}
					{{Form::text('name', '',['placeholder'=>"Package Name",'id'=>'name','class'=>'form-control','required'])}}
				</div>

				<div class="form-group mb-3">
					{{Form::label('slug', 'Slug',['class'=>'form-label'])}}
					{{Form::text('slug', '',['placeholder'=>"slug",'id'=>'slug','class'=>'form-control','readonly'])}}
				</div>


				<div class="form-group mb-3">
					{{Form::label('dp_image', 'Display Picture (Optional)',['class'=>'form-label'])}}
					{{Form::file('dp_image', ['class'=>'form-control form-control-sm', 'type'=>'file'])}}
				</div>
				
				<div class="form-group mb-3">
					{{Form::label('price', 'Price Kshs',['class'=>'form-label'])}}
					{{Form::text('price', '',['placeholder'=>"1,000",'id'=>'price','class'=>'form-control','required'])}}
				</div>

				<div class="row mb-3">
					<div class="col">
						{{Form::label('products', 'Available Products',['class'=>'form-label'])}}
						<div class="row">
							@isset($fireworks)
							
								@foreach($fireworks as $firework)
								<div class="col-md-4">
									<div class="form-check mb-2">
										{{Form::checkbox('products[]', $firework->id)}}
										{{Form::label('blue', $firework->name." Kshs ".$firework->price,['class'=>'form-check-label'])}}


									</div>
								</div>
								
								@endforeach
							
							@endisset
							
						</div>
						
						
					</div>
				</div>

				<div class="form-group">
					{{Form::label('description', 'Description',['class'=>'form-label'])}}
					{{Form::textarea('description', '',['placeholder'=>"DESCRIPTION",'id'=>'ckeditor','class'=>'form-control'])}}
				</div>

				<div class="form-group mb-3">
					{{Form::label('tags', 'Package Tags (Comma Separated)',['class'=>'form-label'])}}
					{{Form::text('tags', '',['placeholder'=>"Birthday Party",'id'=>'tags','class'=>'form-control','required'])}}
				</div>

				{{Form::submit('Submit',['class'=>'btn btn-primary btn-lg form-control my-3'])}}
				{!! Form::close() !!}

				{{-- <button class="btn btn-primary btn-lg" type="button">Example button</button> --}}
			</div>
		</div>
		
	</div>



@endsection

@section('bottom_scripts')
<script>
	$('#name').change(function(e){
		$.get('{{route('packages.checkSlug')}}',
			{ 'name': $(this).val() },
			function(data){
				$('#slug').val(data.slug);
			});
	});
</script>
@endsection
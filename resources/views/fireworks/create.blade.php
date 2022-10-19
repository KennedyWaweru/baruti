@extends('layouts.master')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token()}}">
@endsection


@section('content')
	<div class="container-fluid">
		<div class="p-5 mb-4 bg-light rounded-3">
			<div class="container-fluid py-5">
				<h1 class="display-5 fw-bold text-center">Upload Firework</h1>
				
				{!! Form::open(['action' => 'FireworkController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

				<div class="form-group mb-3">
					{{Form::label('name', 'Product Name',['class'=>'form-label'])}}
					{{Form::text('name', '',['placeholder'=>"Product Name",'id'=>'name','class'=>'form-control','required'])}}
				</div>

				<div class="form-group mb-3">
					{{Form::label('slug', 'Slug',['class'=>'form-label'])}}
					{{Form::text('slug', '',['placeholder'=>"slug",'id'=>'slug','class'=>'form-control','readonly'])}}
				</div>

				<div class="form-group mb-3">
					{{Form::label('category', 'Category',['class'=>'form-label'])}}
					{{-- {{Form::select('category', [1 => 'Rocket', 2 => 'Cake',3=>'Roman Candle',4=>'Fountain',5=>'Sparkler',6=>'Parachute'],'', ['class'=>'form-select'])}} --}}
					{{Form::select('category', $categories,'', ['class'=>'form-select'])}}
				</div>

				<div class="form-group mb-3">
					{{Form::label('dp_image', 'Display Picture',['class'=>'form-label'])}}
					{{Form::file('dp_image', ['class'=>'form-control form-control-sm', 'type'=>'file','required'])}}
				</div>

				<div class="row mb-3">
					{{Form::label('images', 'Images',['class'=>'form-label'])}}
					<div class="col">
						{{Form::file('images[]', ['class'=>'form-control form-control-sm', 'type'=>'file'])}}
					</div>
					<div class="col">
						{{Form::file('images[]', ['class'=>'form-control form-control-sm', 'type'=>'file'])}}
					</div>
					<div class="col">
						{{Form::file('images[]', ['class'=>'form-control form-control-sm', 'type'=>'file'])}}
					</div>
				</div>
				
				<div class="form-group mb-3">
					{{Form::label('price', 'Price Kshs',['class'=>'form-label'])}}
					{{Form::text('price', '',['placeholder'=>"1,000",'id'=>'price','class'=>'form-control','required'])}}
				</div>

				<div class="form-group mb-3">
					{{Form::label('video_url', 'Video Link',['class'=>'form-label'])}}
					{{Form::text('video_url', '',['placeholder'=>"https://www.youtube.com/video",'id'=>'vid_url','class'=>'form-control'])}}
				</div>


				<div class="row mb-3">
					<div class="col">
						{{Form::label('colors', 'Colors',['class'=>'form-label'])}}
						<div class="row">
							<div class="col">
								<div class="form-check mb-2">
									{{Form::checkbox('colors[]', 'Blue', true)}}
									{{Form::label('blue', 'Blue',['class'=>'form-check-label'])}}

								</div>
								<div class="form-check mb-2">
									{{Form::checkbox('colors[]', 'Red')}}
									{{Form::label('Red', 'Red',['class'=>'form-check-label'])}}
								</div>
							</div>

							<div class="col">
								<div class="form-check mb-2">
									{{Form::checkbox('colors[]', 'Green')}}
									{{Form::label('green', 'Green',['class'=>'form-check-label'])}}

								</div>
								<div class="form-check mb-2">
									{{Form::checkbox('colors[]', 'Yellow')}}
									{{Form::label('yellow', 'Yellow',['class'=>'form-check-label'])}}
								</div>
							</div>

							<div class="col">
								<div class="form-check mb-2">
									{{Form::checkbox('colors[]', 'Orange')}}
									{{Form::label('orange', 'Orange',['class'=>'form-check-label'])}}

								</div>
								<div class="form-check mb-2">
									{{Form::checkbox('colors[]', 'Purple')}}
									{{Form::label('purple', 'Purple',['class'=>'form-check-label'])}}
								</div>
							</div>
						</div>
						
						
					</div>
					<div class="col">
						{{Form::label('shots', 'No of Shots',['class'=>'form-label'])}}
						{{Form::number('shots','1', ['class'=>'form-control'])}}
					</div>
					<div class="col">
						{{Form::label('stock', 'In Stock',['class'=>'form-label'])}}
						{{Form::number('stock','1', ['class'=>'form-control'])}}
					</div>
					<div class="col">
						{{Form::label('height', 'Height',['class'=>'form-label'])}}
						{{Form::select('height',['1'=>'150-300','2'=>'150-300','3'=>'300-400',4=>'400-500'],'', ['class'=>'form-select'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('description', 'Description',['class'=>'form-label'])}}
					{{Form::textarea('description', '',['placeholder'=>"DESCRIPTION",'id'=>'ckeditor','class'=>'form-control'])}}
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
		$.get('{{route('fireworks.checkSlug')}}',
			{ 'name': $(this).val() },
			function(data){
				$('#slug').val(data.slug);
			});
	});
</script>
@endsection
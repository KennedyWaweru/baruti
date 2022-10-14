@extends('layouts.master')

@isset($firework)
@section('content')
<div class="container-fluid">
	<div class="p-5 mb-4 bg-light rounded-3">
		<div class="container-fluid py-5">
			<h1 class="display-5 fw-bold text-center">Upload Firework</h1>

			{!! Form::open(['action' => ['FireworkController@update',$firework], 'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
			{{Form::text('id',$firework->id,['hidden'])}}
			<div class="form-group mb-3">
				{{Form::label('name', 'Product Name',['class'=>'form-label'])}}
				{{Form::text('name', $firework->name,['placeholder'=>"Product Name",'id'=>'name','class'=>'form-control','required','readonly'])}}
			</div>

			<div class="form-group mb-3">
				{{Form::label('slug', 'Slug',['class'=>'form-label'])}}
				{{Form::text('slug', $firework->slug,['placeholder'=>"slug",'id'=>'slug','class'=>'form-control','readonly'])}}
			</div>

			<div class="form-group mb-3">
				{{Form::label('category', 'Category',['class'=>'form-label'])}}
				{{Form::select('category', [1 => 'Rocket', 2 => 'Cake',3=>'Roman Candle',4=>'Fountain',5=>'Sparkler',6=>'Parachute'],$firework->category_id, ['class'=>'form-select'])}}
			</div>

			<div class="form-group mb-3">
				{{Form::label('dp_image', 'Display Picture',['class'=>'form-label'])}}
				{{Form::file('dp_image', ['class'=>'form-control form-control-sm', 'type'=>'file'])}}
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
				{{Form::text('price', $firework->price,['placeholder'=>"1,000",'id'=>'price','class'=>'form-control','required'])}}
			</div>

			<div class="form-group mb-3">
				{{Form::label('video_url', 'Video Link',['class'=>'form-label'])}}
				{{Form::text('video_url', $firework->video_url,['placeholder'=>"https://www.youtube.com/video",'id'=>'vid_url','class'=>'form-control'])}}
			</div>


			<div class="row mb-3">
				<div class="col">
					{{Form::label('colors', 'Colors',['class'=>'form-label'])}}
					<div class="row">
						<div class="col">
							@php
								$colors_json = json_decode($firework->effect_colors);
								$blue = in_array('Blue', $colors_json) ? true : false;
								$red = in_array('Red', $colors_json) ? true :false;
								$green = in_array('Green', $colors_json) ? true :false;
								$yellow = in_array('Yellow', $colors_json) ? true :false;
								$orange = in_array('Orange', $colors_json) ? true :false;
								$purple = in_array('Purple', $colors_json) ? true :false;
							@endphp

							<div class="form-check mb-2">
								@php
									echo Form::checkbox('colors[]', 'Blue', $blue);
								@endphp
								{{-- {{Form::checkbox('colors[]', 'Blue', true)}} --}}
								{{Form::label('blue', 'Blue',['class'=>'form-check-label'])}}

							</div>
							<div class="form-check mb-2">
								@php
									echo Form::checkbox('colors[]', 'Red', $red);
								@endphp
								{{Form::label('Red', 'Red',['class'=>'form-check-label'])}}
							</div>
						</div>

						<div class="col">
							<div class="form-check mb-2">
								@php
									echo Form::checkbox('colors[]', 'Green', $green);
								@endphp
								{{Form::label('green', 'Green',['class'=>'form-check-label'])}}

							</div>
							<div class="form-check mb-2">
								@php
									echo Form::checkbox('colors[]', 'Yellow', $yellow);
								@endphp
								{{Form::label('yellow', 'Yellow',['class'=>'form-check-label'])}}
							</div>
						</div>

						<div class="col">
							<div class="form-check mb-2">
								@php
									echo Form::checkbox('colors[]', 'Orange', $orange);
								@endphp
								{{Form::label('orange', 'Orange',['class'=>'form-check-label'])}}

							</div>
							<div class="form-check mb-2">
								@php
									echo Form::checkbox('colors[]', 'Purple', $purple);
								@endphp
								{{Form::label('purple', 'Purple',['class'=>'form-check-label'])}}
							</div>
						</div>
					</div>


				</div>
				<div class="col">
					{{Form::label('shots', 'No of Shots',['class'=>'form-label'])}}
					{{Form::number('shots',$firework->number_of_shots, ['class'=>'form-control'])}}
				</div>
				<div class="col">
					{{Form::label('stock', 'In Stock',['class'=>'form-label'])}}
					{{Form::number('stock',$firework->stock, ['class'=>'form-control'])}}
				</div>
				<div class="col">
					{{Form::label('height', 'Height',['class'=>'form-label'])}}
					{{Form::select('height',['1'=>'150-300','2'=>'150-300','3'=>'300-400',4=>'400-500'],'', ['class'=>'form-select'])}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('description', 'Description',['class'=>'form-label'])}}
				{{Form::textarea('description', $firework->description,['placeholder'=>"DESCRIPTION",'id'=>'ckeditor','class'=>'form-control'])}}
			</div>

			{{Form::submit('Submit',['class'=>'btn btn-primary btn-lg form-control my-3'])}}
			{!! Form::close() !!}

			{{-- <button class="btn btn-primary btn-lg" type="button">Example button</button> --}}
		</div>
	</div>

</div>
@endsection

@endisset




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
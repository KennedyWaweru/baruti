@extends('layouts.master')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token()}}">
@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.1/basic/ckeditor.js"></script>

@endsection

@section('styles')

@endsection


@section('content')
	<div class="container">
		{!! Form::open(['action' => 'ProductController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
		
		<div class="form-group">
			{{Form::label('name', 'Product Name')}}
			{{Form::text('name', '',['placeholder'=>"Product Name",'id'=>'name','class'=>'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('slug', 'Slug')}}
			{{Form::text('slug', '',['placeholder'=>"slug",'id'=>'slug','class'=>'form-control','readonly'])}}
		</div>
		
		<div class="form-group">
			{{Form::label('description', 'Description')}}
			{{Form::textarea('description', '',['placeholder'=>"slug",'id'=>'ckeditor','class'=>'form-control'])}}
		</div>
		<div class="form-group form-inline">
			<div class="col">
				{{Form::label('Stock', 'Stock')}}
				{{Form::number('stock', '2')}}
			</div>
			<div class="col">
				{{Form::label('price', 'Price (Kshs)')}}
				{{Form::number('price', '100')}}
			</div>
			<div class="col">
				{{Form::label('quantity', 'Quantity')}}
				{{Form::number('quantity', '5')}}
			</div>
		</div>
		

		{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
		{!! Form::close() !!}
	</div>

@endsection

@section('bottom_scripts')
	<script type="text/javascript">
	CKEDITOR.replace( 'ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script>
	$('#name').change(function(e){
		$.get('{{route('products.checkSlug')}}',
			{ 'name': $(this).val() },
			function(data){
				$('#slug').val(data.slug);
			});
	});
</script>
@endsection
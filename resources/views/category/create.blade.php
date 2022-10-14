@extends('layouts.master')

@section('content')
	<div class="container">
		<div class="row">
			<div class="rounded bordered bg-light my-2 p-3">
				{!! Form::open(['route'=>'category.store','method'=>'POST','files'=>true]) !!}
				<div class="form-group m-1">
					{{Form::label('name', 'Name',['class'=>'form-label'])}}
					{{Form::text('name', '',['placeholder'=>"Name",'class'=>'form-control'])}}
				</div>
				<div class="form-group m-1">
					{{Form::label('description', 'Description',['class'=>'form-label'])}}
					{{Form::textarea('description', '',['placeholder'=>"DESCRIPTION",'id'=>'ckeditor','class'=>'form-control'])}}
				</div>

				<div class="form-group m-1">
					{{Form::label('image', 'Image',['class'=>'form-label'])}}
					{{Form::file('image', ['class'=>'form-control form-control-sm', 'type'=>'file','required'])}}
				</div>

				{!! Form::submit('Submit',['class'=>'form-control btn-outline-success my-3']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
@endsection

@section('bottom_scripts')
<script>
	$('#name').change(function(e){
		$.get('{{route('category.checkSlug')}}',
			{ 'name': $(this).val() },
			function(data){
				$('#slug').val(data.slug);
			});
	});
</script>
@endsection
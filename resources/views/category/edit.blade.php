@extends('layouts.master')

@section('content')
	<div class="container">
		@isset($category)
		<div class="rounded bordered bg-light my-2 p-3">
			{!! Form::open(['action'=>['CategoryController@update',$category],'method'=>'PUT','files'=>true]) !!}
			@method('PUT')
			<div class="form-group m-1">
				{{Form::label('name', 'Name',['class'=>'form-label'])}}
				{{Form::text('name', $category->name,['placeholder'=>"Name",'class'=>'form-control'])}}
			</div>
			<div class="form-group m-1">
				{{Form::label('description', 'Description',['class'=>'form-label'])}}
				{{Form::textarea('description', $category->description,['placeholder'=>"DESCRIPTION",'id'=>'ckeditor','class'=>'form-control'])}}
			</div>

			<div class="form-group m-1">
				{{Form::label('image', 'Image',['class'=>'form-label'])}}
				{{Form::file('image', ['class'=>'form-control form-control-sm', 'type'=>'file'])}}
			</div>

			{!! Form::submit('Submit',['class'=>'form-control btn-outline-success my-3']) !!}
			{!! Form::close() !!}
		</div>

	@else
	Not found
	@endisset
	</div>
	
@endsection
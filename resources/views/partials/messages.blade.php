@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li class="h4">{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

@if(session('error'))
	<div class="alert alert-danger fs-4">
		{{session('error')}}
	</div>
@endif

@if(session('success'))
	<div class="alert alert-success fs-4">
		{{session('success')}}
	</div>
@endif
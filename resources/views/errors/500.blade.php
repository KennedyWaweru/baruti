@extends('layouts.master')

@section('content')
	<div class="container d-flex align-items-center justify-content-center" style="height: 80vh; width: 100%;">
		<div class="d-flex align-items-center justify-content-center">
			<div class="w-100 h-100 rounded-3 alert alert-warning border border-danger p-5 text-center">
				<span style='font-size:100px;'>&#128529;</span>
				<span style='font-size:100px;'>&#128529;</span>
				<h2 class="my-3 text-info">Internal Server Error! Kindly wait as we fix it... </h2>
				<a href="{{route('fireworks.index')}}", role="button" class="btn btn-primary btn-lg">
					Go Home
				</a>
			</div>
		</div>
		
	</div>
@endsection
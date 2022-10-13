{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

@extends('layouts.master')

@section('content')
	<div class="container d-flex align-items-center justify-content-center" style="height: 80vh; width: 100%;">
		<div class="d-flex align-items-center justify-content-center">
			<div class="w-100 h-100 rounded-3 bg-secondary border border-danger p-5 text-center">
				<span style='font-size:100px;'>&#128529;</span>
				<span style='font-size:100px;'>&#128529;</span>
				<h2 class="my-3 text-white">Sorry! Page Not Found </h2>
				<a href="{{route('fireworks.index')}}", role="button" class="btn btn-primary btn-lg">
					Go Home
				</a>
			</div>
		</div>
		
	</div>
@endsection
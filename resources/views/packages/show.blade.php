@extends('layouts.master')

@section('content')
	<div class="container">
		@isset($package)
			<h1>
				 @livewire('package-table',['package'=>$package])
			</h1>
		@endisset
		{{-- @livewire('package',['package'=>$package]) --}}
	</div>
@endsection
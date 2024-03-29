@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row  bg-secondary p-5">
		<div class="col-md-7 bg-light p-3">
			<div class="row my-3">
				<div class="tl-container">
					<ul class="timeline">
						<li class="active-tl">
							Delivery

						</li>
						<li>
							Payment

						</li>
						<li>
							Confirmation

						</li>
					</ul>
				</div>
			</div>
			@livewire('order', ['buyNow'=>True,'itemSlug'=>$package->slug])
		</div>
		 <div class="col-md-5 col-sm-12 bg-success text-white p-3">
		 	{{-- Package/product thats on Buy Now --}}
            
             @livewire('buy-now-summary', ['item_slug'=>$package->slug])
	 	</div>
	</div>
</div>
@endsection
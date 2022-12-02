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
			@livewire('order')
		</div>
		 <div class="col-md-5 col-sm-12 bg-success text-white p-3">
		 	{{-- Package/product thats on Buy Now --}}
             @isset($package)
             <h1>Package is set</h1>
             {{-- <div class="table-responsive-sm cart-summary">
                 <table class="table table-success table-striped table-hover">
                     <thead class="table-dark">
                         <tr>
                             <td>Item</td>
                             <td>Price</td>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach($package->fireworks as $order_firework)
                            <tr>
                                <td>{{$order_firework->name}}</td>
                                <td>{{$order_firework->pivot->quantity}}</td>
                            </tr>
						@endforeach
                       
                         <tfoot>
                             @if($cart_total < 1000)
                             <tr class="fw-bold">
                                 <td>Delivery Fee</td>
                                 <td>
                                     500
                                    
                                </td>
                             </tr>
                             <tr class="fw-bold">
                                 <td>Total</td>
                                 <td>
                                    {{$cart_total}}
                                </td>
                             </tr>
                             <div class="alert alert-warning fs-6" role="alert">
                                 Orders below Kshs 2,000 will incur an extra Kshs 500 Delivery Fee!
                           </div>
                             @else
                             <tr class="fw-bold">
                                 <td>Total</td>
                                 <td>
                                    {{number_format($package->price)}}
                                </td>
                             </tr>
                            @endif
                        </tfoot>
                     </tbody>
     
                </table>
            </div> --}}
            @endisset
	 	</div>
	</div>
</div>
@endsection
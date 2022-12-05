@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row bg-secondary p-5">
        <div class="col-md-8 bg-light p-3">
            <div class="row my-3">
                <div class="tl-container">
                    <ul class="timeline">
                        <li class="active-tl">
                            Delivery

                        </li>
                        <li  class="active-tl">
                            Payment

                        </li>
                        <li class="active-tl">
                            Confirmation

                        </li>
                    </ul>
                </div>
            </div>
           
           @isset($order)
           
           <div class="card text-dark @if($order->delivery_status) bg-success @else bg-light @endif @if($order->payment_status) border-success @else border-danger @endif mb-3">
           	<div class="card-header @if($order->payment_status) bg-success @else bg-info @endif">{{$order->name}} 
           		<span class="badge bg-light text-dark float-end fs-6">
           			@if($order->delivery_status)
           				<span class="fs-5">
           					<i class="fas fa-truck-moving"></i>
           				</span>
           			@endif
           			@if($order->payment_status) 
           				<span class="fs-6">
           					Kshs {{$order->amount}}
           				<i class="fas fa-check text-primary"></i>
           				</span>
       				@else
       					<span class="fs-6">
           					Kshs {{$order->amount}}
           				<i class="fas fa-hourglass-half text-warning"></i>
           				</span>
           			@endif
           		</span>
           </div>
           	<div class="card-body">
           		<div class="row">
           			<div class="col-md-4 col-sm-12">
           				<h5 class="card-title">{{$order->phone}}</h5>
           				<p class="card-text">
           					{{$order->location}}
           				</p>
           			</div>
           			<div class="col-md-4 col-sm-12">
           				{{-- <h5 class="card-title">Order Items</h5> --}}
           				<div class="card-text">
           					@empty($order->packages)

           					@else
           					<h4 class="text-center text-info">Packages:</h4>
           					<table class="table table-sm">
           					{{-- <ul class="list-group list-group-flush"> --}}
           						<thead>
           							<tr>
           								<th scope="col">Package</th>
           								<th scope="col">QTY</th>
           							</tr>
           						</thead>
	           					@foreach($order->packages as $order_pack)
	           					<tbody>
	           						<tr>
	           							<td>{{$order_pack->name}}</td>
	           							<td>{{$order_pack->pivot->quantity}}</td>
	           						</tr>
									
									   <tr>
										<td colspan="4">
										  <table class="table mb-0">
											<thead class="table-dark">
												<tr>
													<th scope="col">Product</th>
													<th scope="col">QTY</th>
												</tr>
											</thead>
											@foreach($order_pack->fireworks as $order_firework)
												<tr>
													<td>{{$order_firework->name}}</td>
	           										{{--<td>{{$order_firework->pivot->quantity}}</td>--}}
													<td>{{$order_firework->pivot->quantity}}</td>
												</tr>
											@endforeach
										  </table>
										</td>
									  </tr>

	           					</tbody>
	           						{{-- <li class="list-group-item">{{$order_pack->name}}</li> --}}
	           					@endforeach
           					</table>
           					@endisset

           					@isset($order->fireworks)
           					<h4 class="text-center text-primary">Products</h4>
           					<table class="table table-sm">
           					{{-- <ul class="list-group list-group-flush"> --}}
           						<thead class="table-dark">
           							<tr>
           								<th scope="col">Product</th>
           								<th scope="col">QTY</th>
           							</tr>
           						</thead>
           					{{-- <ul class="list-group list-group-flush"> --}}
           						@foreach($order->fireworks as $order_firework)
           						<tbody>
	           						<tr>
	           							<td>{{$order_firework->name}}</td>
	           							<td>{{$order_firework->pivot->quantity}}</td>
	           						</tr>
	           					</tbody>
           						{{-- <li class="list-group-item">
           							{{$order_firework->name}}
           						</li> --}}
           						@endforeach
           					</table>
       						{{-- </ul> --}}
           					@endisset
           				</div>
           			</div>
					
           			<div class="col-md-4 col-sm-12">

						{{-- Check if order has been paid for--}}
						@if($order->payment_status) 
							@if($order->delivery_status)
								<div class="m-2 p-2 bg-info text-white text-center">
									Delivery Complete
								</div>
								
							@else
								<div class="m-2 p-2 bg-alert text-white text-center">
									Delivery Pending
								</div>
							@endif
						@else 
						<div class="p-2 m-2 bg-danger text-center text-white">Payment Not Complete. Please Go back and Complete Payment via M-Pesa Online</div>
						<a href="{{route('order')}}" role="button" class="btn btn-outline-success">Complete Payment</a>
						@endif
           			</div>
           		</div>
           		
           	</div>
           	<div class="card-footer bg-transparent">
           		<div class="row">
           			<div class="col">Created At: {{$order->created_at->diffForHumans()}}</div>
           			<div class="col">Deliver On: {{$order->delivery}}</div>
           		</div>
           	</div>
           </div>
           @endisset
        </div>
        

    </div>
</div>
@endsection
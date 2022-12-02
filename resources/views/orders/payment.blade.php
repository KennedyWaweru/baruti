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
                        <li  class="active-tl">
                            Payment

                        </li>
                        <li>
                            Confirmation

                        </li>
                    </ul>
                </div>
            </div>
            @isset($form_details)

            @livewire('order-payment', ['form_details'=>$form_details,'payment_phone'=>$form_details['phone'],'order_id'=>$order_id])
            @else
            No form data available
            @endisset
        </div>
        <div class="col-md-5 col-sm-12 bg-success text-white p-3">
            @isset($buyNow)
                <h2 class="text-center fs-3 text-dark">Buy Now</h2>
            @else
                @livewire('cart-summary')
            @endisset
        </div>

    </div>
</div>
@endsection

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
                        <li class="active-tl">
                            Confirmation

                        </li>
                    </ul>
                </div>
            </div>
           
           @isset($order)
           {{var_dump($order)}}
           @endisset
        </div>
        

    </div>
</div>
@endsection
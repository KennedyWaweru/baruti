<div>


    {!! Form::open(['action' => 'OrderController@paymentOrder', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'class'=>'row g-3']) !!}
    <div class="col-md-6">
        <label for="first_name" class="form-label">First Name</label>
        @empty(old('first_name'))
        {!! Form::text('first_name',Cookie::get('order_f_name'),['class'=>'form-control']) !!}
        {{-- <input type="text" value="{{cache('order_f_name')}}" required class="form-control" name="first_name"> --}}
        @else
        <input type="text" value="{{old('first_name')}}" required class="form-control" name="first_name">
        @endempty
    </div>
    <div class="col-md-6">
        <label for="second_name" class="form-label">Second Name</label>
        @empty(old('second_name'))
        <input type="text" value="{{Cookie::get('order_s_name')}}" required class="form-control" name="second_name">
        @else
        <input type="text" value="{{old('second_name')}}" required class="form-control" name="second_name">
        @endempty
    </div>

    <div class="col-12">
        <label for="contact-phone" class="form-label">Contact Phone</label>
        @empty(old('phone'))
        <input type="text" value="{{Cookie::get('order_phone')}}" required class="form-control" name="phone" placeholder="07 _ _ _ _ _ _ _ _">
        @else
        <input type="text" value="{{old('phone')}}" required class="form-control" name="phone" placeholder="07 _ _ _ _ _ _ _ _">
        @endempty
    </div>
    <div class="col-12">
        <label for="email" class="form-label">Email Address</label>
        @empty(old('email'))
        <input type="email" value="{{Cookie::get('order_email')}}" required class="form-control" name="email" placeholder="youremail@address.com">
        @else
        <input type="email" value="{{old('email')}}" required class="form-control" name="email" placeholder="youremail@address.com">
        @endempty
    </div>
    <div class="col-12">
        <label for="location" class="form-label">Location Description</label>
        @empty(old('location'))
        <textarea required id="autocomplete" class="form-control" name="location" placeholder="Enter your correct location details. This includes Location, buildings and offices where you would like the delivery to be made">{{Cookie::get('order_location')}}</textarea>
        @else
        <textarea required id="autocomplete" class="form-control" name="location" placeholder="Enter your correct location details. This includes Location, buildings and offices where you would like the delivery to be made">{{old('location')}}</textarea>
        @endempty
    </div>
    <div class="col-12">
        <label for="delivery-day" class="form-label">Delivery Day</label>
        {{Form::select('delivery_day',['1'=>'Today','2'=>'Tomorrow'],'', ['class'=>'form-select'])}}
    </div>
    <div class="col-12 text-center">
        {{Form::submit('Submit',['class'=>'btn btn-primary btn-lg form-control my-3'])}}
        {!! Form::close() !!}
    </div>
    @isset('buyNow')
        <h2>Buy Now</h2>
    @endisset

</div>

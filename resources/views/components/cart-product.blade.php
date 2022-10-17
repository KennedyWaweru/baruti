<tr>
  <td>
    <div class="container">
      <div class="row">
        <div class="col-6" id="thumb-div">
          {{-- <img src="{{asset($cart_product_image)}}" alt="" class="img-fluid img-thumbnail"> --}}
          <img src="{{env('AWS_BUCKET_URL').$cart_product_image}}" alt="" class="img-fluid img-thumbnail">
      </div>
      <div class="col-6">
          <h6 class="my-title"><strong>{{$cart_product_name}}</strong></h6>
      </div>
  </div>
</div>
</td>
<td>
    <div class="container">
      <form class="form row align-items-center g-1" wire:submit.prevent>
          <div class="row">

            <div class="col">
              <button class="btn btn-secondary" wire:click.delay="decrement({{$cart_product_id}})">&minus;</button>
          </div>
          <div class="col">

            <input type="text" id="quantity" class="form-control-plaintext form-control-sm"
             value="{{$cart_product_quantity}}" readonly="" disabled=""
             wire:model.lazy="quantity.{{$cart_product_quantity}}">

        </div>

        <div class="col">
          @if($cart_product_quantity < $cart_product_stock)
          <button class="btn btn-secondary" wire:click.delay="increment({{$cart_product_id}}, 
          {{$cart_product_stock}})">&plus;</button>
          @else
          <p class="text-center">Max</p>
          @endif
      </div>
  </div>
</form>
</div>
</td>
<td>{{$cart_product_price}}</td>
{{-- <td>{{$cart_product_quantity * $cart_product_price}}</td> --}}
<td>
    <a role="button" id="rem" class="fs-3" wire:click.prevent="$emit('removedFromCart', {{$cart_product_id}})">&times;</a>
</td>
</tr>
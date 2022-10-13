<div>
  @if($count>0)
  <a role="button" data-bs-toggle="modal" data-bs-target="#cartModal">
    <span id="fab">
        <i class="fas fa-shopping-cart">
          
        </i> 
        <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">{{$count}}</span>
        <span class="visually-hidden">items in cart</span>
    </span>
  </a>
  @endif

<!-- Show shopping cart in a modal -->
<!-- Modal -->

<x-shopping-cart>
  @empty($products_in_cart)
      <div class="rounded-3 w-100 text-center bg-danger py-3 border">
        <h2 class="text-white">Cart is Empty!</h2>
      </div>
  @else
    @foreach($products_in_cart as $product_key=>$product_in_cart)
      {{-- Cart items ids are type int for products and strings (slugs) for packages --}}
      <hr class="visually-hidden">
      @if(is_int($product_key))
        <tr>
              <td>
                <div class="container">
                  <div class="row">
                    <div class="col-6" id="thumb-div">
                      <img src="{{asset($product_in_cart['image_url'])}}" alt="" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-6">
                      <h6 class="my-title"><strong>{{$product_in_cart['name']}}</strong></h6>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="container">
                  <form class="form row align-items-center g-1" wire:submit.prevent>
                    <div class="row">

                      <div class="col">
                        <button class="btn btn-secondary" wire:click.delay="decrement({{$product_in_cart['id']}})">&minus;</button>
                      </div>
                      <div class="col">

                        <input type="text" id="quantity" class="form-control-plaintext form-control-sm" value="{{$quantity[$product_in_cart['id']]}}" readonly="" disabled="" wire:model.lazy="quantity.{{$product_in_cart['id']}}">

                      </div>

                      <div class="col">
                        @if($quantity[$product_in_cart['id']] < $product_in_cart['stock'])
                        <button class="btn btn-secondary" wire:click.delay="increment({{$product_in_cart['id']}}, {{$product_in_cart['stock']}})">&plus;</button>
                        @else
                        <p class="text-center">Max</p>
                        @endif
                      </div>
                    </div>
                  </form>
                </div>
              </td>
              <td>{{$product_in_cart['price']}}</td>
              <td>{{$quantity[$product_in_cart['id']] * $product_in_cart['price']}}</td>
              <td>
                <a role="button" id="rem" class="fs-3" wire:click.prevent="$emit('removedFromCart', {{$product_in_cart['id']}})">&times;</a>
              </td>
            </tr>
      @else
        {{-- Rename variable $product_in_cart to $package_in_cart --}}
        @php
        $package_in_cart = $product_in_cart;
        @endphp

         <tr>
              <td>
                <div class="container">
                  <div class="row">
                    <div class="col-6" id="thumb-div">
                      <img src="{{asset($package_in_cart['image_url'])}}" alt="" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-6">
                      <h6 class="my-title"><strong>{{$package_in_cart['name']}}</strong></h6>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="container">
                  <form class="form row align-items-center g-1" wire:submit.prevent>
                    <div class="row">

                      <div class="col">
                        <button class="btn btn-secondary" wire:click.delay="decrement('{{$package_in_cart['slug']}}')">&minus;</button>
                      </div>
                      <div class="col">

                        <input type="text" id="quantity" class="form-control-plaintext form-control-sm" value="{{$quantity[$package_in_cart['slug']]}}" readonly="" disabled="" wire:model.lazy="quantity.{{$package_in_cart['slug']}}">

                      </div>

                      <div class="col">
                        @if($quantity[$package_in_cart['slug']] < $package_in_cart['stock'])
                        <button class="btn btn-secondary" wire:click.delay="increment('{{$package_in_cart['slug']}}', {{$package_in_cart['stock']}})">&plus;</button>
                        @else
                        <p class="text-center">Max</p>
                        @endif
                      </div>
                    </div>
                  </form>
                </div>
              </td>
              <td><p class="text-decoration-line-through">{{(int)$package_in_cart['original_price']}}</p>
                <p>{{(int)$package_in_cart['price']}}</p></td>
              <td>{{$quantity[$package_in_cart['slug']] * $package_in_cart['price']}}</td>
              <td>
                <a role="button" id="rem" class="fs-3" wire:click.prevent="$emit('removedFromCart', '{{$package_in_cart['slug']}}')">&times;</a>
              </td>
            </tr>
      @endif
    @endforeach
    
  @endempty
</x-shopping-cart>
</div>

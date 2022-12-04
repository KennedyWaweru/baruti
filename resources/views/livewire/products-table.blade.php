<section class="featured-products">
    <div class="row">
        <div class="col-md-8">
            <h2 class="text-center text-white">Featured Products</h2>
        </div>
        <div class="col-md-4">
            <a wire:click="sortOnPrice" role="button" class="btn float-left fs-5 text-info">
                Sort by price
                <span id="productSort">
                    <i class="fas fa-solid fa-sort text-blue"></i>
                </span>
            </a>
        </div>
        
        @foreach($products as $product)
        <div class="col-md-4">
            <x-product-card>
                <x-slot name="image_url"> {{$product->image_url}} </x-slot>
                <x-slot name="name"> {{$product->name}} </x-slot>
                <x-slot name="price">{{$product->price}} </x-slot>
                <x-slot name="slug">{{$product->slug}} </x-slot>
                <x-slot name="product_id">{{$product->id}}</x-slot>
                <x-slot name="stock">{{(int)$product->stock}}</x-slot>
                @if((int)$product->stock < 1)
                <x-slot name="in_stock">{{false}}</x-slot>
                @endif
                {{Str::limit($product->description,20)}}
            </x-product-card>
        </div>

        @endforeach
    </div>

    <div class="row" id="moreProducts">
        {{-- This row contains the progress bar for loading more products --}}
        <div wire:loading.delay wire:target="moreProducts">
            <div class="text-center my-2">
                <div class="spinner-border spinner-grow text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-border spinner-grow text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-border spinner-grow text-warning" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                  
              </div>
        </div>
        
    </div>

    {{-- This row has the moreProducts CTA--}}
    <div class="row text-center mt-3 mx-5" id="more-btn">
        @if($has_more_products)
        <a wire:click.prevent="moreProducts" wire:loading.remove role="button" class="btn btn-lg btn-outline-light bg-danger bg-gradient">
            More Products <br>
            <span id="arrow-down">
                <i class="fas fa-angle-double-down"></i>
            </span>
        </a>
        @else
            <h1>No More Products</h1>
        @endif
    </div>
</section>

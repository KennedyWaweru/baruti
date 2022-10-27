<section class="featured-products">
    <div class="row">
        <h2 class="text-center text-white">Featured Products</h2>
        @foreach($products as $product)
        @if((int)$product->stock >= 1)
        <div class="col-md-4">
            <x-product-card>
                <x-slot name="image_url"> {{$product->image_url}} </x-slot>
                <x-slot name="name"> {{$product->name}} </x-slot>
                <x-slot name="price">{{$product->price}} </x-slot>
                <x-slot name="slug">{{$product->slug}} </x-slot>
                <x-slot name="product_id">{{$product->id}}</x-slot>
                <x-slot name="stock">{{(int)$product->stock}}</x-slot>
                {{Str::limit($product->description,20)}}
            </x-product-card>
        </div>
        @else 
        @auth
            @can('admin')
            <div class="col-md-4">
                <x-product-card>
                    <x-slot name="image_url"> {{$product->image_url}} </x-slot>
                    <x-slot name="name"> {{$product->name}} </x-slot>
                    <x-slot name="price">{{$product->price}} </x-slot>
                    <x-slot name="slug">{{$product->slug}} </x-slot>
                    <x-slot name="product_id">{{$product->id}}</x-slot>
                    <x-slot name="stock">{{(int)$product->stock}}</x-slot>
                    {{Str::limit($product->description,20)}}
                </x-product-card>
            </div>
            @endcan
        @endauth
        @endif

        @endforeach
    </div>


    <div class="row text-center mt-3 mx-5" id="more-btn">
        <a wire:click.prevent="moreProducts" role="button" class="btn btn-lg btn-outline-light bg-danger bg-gradient">
            More Products <br>
            <span id="arrow-down">
                <i class="fas fa-angle-double-down"></i>
            </span>
        </a>
    </div>
</section>

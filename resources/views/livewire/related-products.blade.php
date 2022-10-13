<div class="row">
    <h3 class="text-center text-white">Related Products</h3>
    @foreach($related_products as $product)
    <div class="col-md-4 col-sm-12">
        <x-product-card>
            <x-slot name="image_url"> {{$product->image_url}} </x-slot>
            <x-slot name="name"> {{$product->name}} </x-slot>
            <x-slot name="price">{{$product->price}} </x-slot>
            <x-slot name="slug">{{$product->slug}} </x-slot>
            <x-slot name="product_id">{{$product->id}}</x-slot>
            <x-slot name="stock">{{$product->stock}}</x-slot>
            {{Str::limit($product->description,20)}}
        </x-product-card>
    </div>
    @endforeach
    
</div>

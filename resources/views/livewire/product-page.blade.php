<div class="row text-center">
    <div class="col-6">
        <form action="">
            {{-- <label for="quantity" class="form-control-label">QTY:</label> --}}
            <input class="form-control" type="number" id="quantity" value=1 name="quantity" min="1" wire:model.delay="quantity" max={{$max_stock}}>
        </form>
    </div>
    <div class="col-6">
        <a {{-- wire:click.prevent="addToCart({{$product_id}})" --}} wire:click="$emit('addProductToCart', {{$product_id}},{{$quantity}})" role="button" class="btn btn-outline-primary">
            <i class="fas fa-cart-plus"></i> <small style="font-size: 0.8rem;">Add to Cart</small>
        </a>
    </div>

</div>

<div class="card m-2 rounded-3 border-info">
    {{--<img src="{{asset($image_url)}}" class="card-img-top img-fluid" alt="..."> --}}
    <img src="{{env('AWS_BUCKET_URL').$image_url}}" class="card-img-top img-fluid" alt="{{$name}}">
    
    @isset($in_stock)
        <div class="card-img-overlay  align-middle">
            <h3 class="text-danger">Out of Stock</h3>
        </div>
    @endisset

    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <a href="{{route('fireworks.show',$slug)}}">
                    <h5 id="title-name" class="card-title text-primary float-start">{{$name}}</h5>
                </a>
            </div>
            <div class="col-4">
                <h6 id="price" class="card-text float-end">{{$price}} /=</h6>
            </div>
        </div>
        <p class="card-text">{{$slot}}</p>
    </div>

    <div class="footer border-info">
        <div class="row text-center">
            <div class="col-sm-4 my-2">
                <a href="{{route('fireworks.show',$slug)}}" {{-- wire:click.prevent="openProductPage({{$product_id}})" --}} class="btn btn-outline-primary" role="button">View</a>
            </div>
            <div class="col-sm-4 my-2">
                <form action="">
                    <label for="quantity">QTY:</label>
                    <input type="number" class="form-control form-control-sm" id="quantity" value=1 {{-- value="{{$quantity.$product_id}}" --}} wire:model.lazy="quantity.{{$product_id}}" min=1 max={{$stock}}>
                </form>
            </div>

            <div class="col-sm-4 my-2">
                <a wire:click.prevent="addToCart('{{$product_id}}')" role="button" class="btn btn-outline-primary">
                    <i class="fas fa-cart-plus"></i>
                </a>
            </div>
        </div>
    </div>
</div>
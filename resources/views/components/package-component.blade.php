<div class="col-sm-12 my-2">
    <!-- Package Card -->
    <div class="card">
        <div class="row g-0">
            <div class="col-4">
                <div class="container">
                    <div class="row g-0">
                        @foreach($package_images as $package_image)
                            {!!env('AWS_BUCKET_URL').$package_image!!}
                        @endforeach
                    </div>
                </div>
                {{-- <img src="{{asset('images/crown_rockets_assortment.jpg')}}" alt="" class="img-fluid rounded-start"> --}}
            </div>
            <div class="col-8">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h5 id="title-name" class="card-title">{{$package_name}}</h5>
                        </div>
                        <div class="col-4">
                            <h6 id="price" class="card-text float-end">Kshs {{$package_price}}/=</h6>
                        </div>
                    </div>

                    <p class="card-text">{!!$package_tags!!}</p>

                    <div class="row">
                        <div class="col-md-4 col-sm-12"><h5>Package Contains: </h5></div>
                        <div class="col-md-8 col-sm-12">
                            <p class="card-text my-1">
                                {{$package_products}}
                            </p>
                        </div>
                    </div>
                    <p class="card-text"> 
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <h5 class="text-center">Description</h5>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                {{$slot}}
                            </div>
                        </div>
                     </p>
                    <hr class="my-2 text-success">
                    <div class="row text-center">
                        <div class="col-sm-4 my-1">
                            <a href="" class="btn btn-outline-primary" role="button">View</a>
                        </div>
                        <div class="col-sm-4 my-1">
                            <form action="">
                                <label for="quantity">QTY:</label>
                                <input type="number" id="quantity" wire:model="qty" class="form-control form-control-sm" value=1 name="quantity" min="1" max={{$package_stock}}>
                            </form>
                        </div>
                        <div class="col-sm-4 my-1">
                            <a wire:click.prevent="addPackageToCart('{{$package_slug}}')" role="button" class="btn btn-outline-primary">
                                <i class="fas fa-cart-plus"></i>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End of package card -->
</div>
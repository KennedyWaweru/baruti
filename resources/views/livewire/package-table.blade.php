<div>
    @isset($package)
        <x-package-component>
            <x-slot name="package_name">{{Str::title($package->name)}}</x-slot>
            <x-slot name="package_price">{{number_format($package->price)}}</x-slot>
            
            @php
                $package_tags=json_decode($package->tags);
                $package_tags_html = [];
                foreach($package_tags as $tag){
                    $package_tags_html[]="<span class='badge bg-info text-dark'>$tag</span>";
                }
                $tags_html = implode(" ",$package_tags_html);

                $package_products = $package->fireworks;
                $products_array = [];
                $products_stock=[];
                $package_images=[];
                foreach($package_products as $product){
                    $products_array[]="<span class='badge bg-light text-dark'>$product->name</span>";
                    $products_stock[]=$product->stock;
                    $product_image="<div class=\"col-sm-6\">\n<img src=\"/env('AWS_BUCKET_URL').$product->image_url\" alt=\"\" class=\"img-fluid rounded-start\">\n\t</div>";
                    $package_images[]=$product_image;
                }
                $package_products_html = implode(",",$products_array);
                $available_stock = min($products_stock);
                $package_images=implode(" ",$package_images);
            @endphp
            
            <x-slot name="package_tags">{!!$tags_html!!}</x-slot>
            <x-slot name="package_products">{!!$package_products_html!!}</x-slot>
            <x-slot name="package_stock">{{$available_stock}}</x-slot>
            <x-slot name="package_slug">{{$package->slug}}</x-slot>
            <x-slot name="package_images">{!!$package_images!!}</x-slot>
            {{$package->description}}
        </x-package-component>
    
    @endisset
</div>

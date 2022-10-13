<?php

namespace App\Http\Livewire;

use App\Package;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;


class PackageTable extends Component
{
    public $package;
    public $qty=1;
    public function render()
    {
        return view('livewire.package-table');
    }

    public function addPackageToCart(Package $package){
        //$package = Firework::findOrFail($product_id);
        /*$qty = (int)$this->quantity[$product->id] <= (int)$product->stock 
                    ? $this->quantity[$product->id] 
                    : $product->stock;*/
        
        $cartItem = Cart::add([
            'id' => $package->slug,
            'name' => $package->name,
            'qty' => (int)$this->qty,
            'options'=>['type'=>'package'],
            'price' => $package->price
        ]);

        $this->emitTo('shopping-cart','cart-updated');
        //dd($package);
    }
}

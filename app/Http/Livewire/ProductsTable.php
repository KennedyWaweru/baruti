<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Firework;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class ProductsTable extends Component
{
    public $products;
    public array $quantity;
    public array $stock;
    public $cursor = 6;
    
    //public $listeners = ['moreProducts'];
    public function mount(){
        //$this->products = Firework::all();
        $this->products = DB::table('fireworks')->limit($this->cursor);
        //$this->products = Firework::forPage(1,4)->collect()->all();
        dd($this->products);
        
        foreach($this->products as $product){
            $this->quantity[$product->id] = 1;
            $this->stock[$product->id] = $product->stock;
        }
    }
    public function render()
    {
        return view('livewire.products-table');
    }

    public function addToCart($product_id){
        $product = Firework::findOrFail($product_id);
        $qty = (int)$this->quantity[$product->id] <= (int)$product->stock 
                    ? $this->quantity[$product->id] 
                    : $product->stock;

        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => (int)$qty,
            'price' => $product->price,
            'options'=>['type'=>'product']
        ])->associate('Firework');

        $this->emitTo('shopping-cart','cart-updated');
    }

    public function moreProducts(){
        $this->cursor += 6;
        $this->mount($this->cursor);
    }
}

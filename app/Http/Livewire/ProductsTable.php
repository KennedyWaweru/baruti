<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Firework;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductsTable extends Component
{
    public $products;
    public array $quantity;
    public array $stock;
    public $current_page = 1;
    public $products_on_page = 9;
    public $has_more_products = true;
    private $num_button_clicked = 1; // this variable will track number of times a user clicks the More Products button
    // initial value is 1 since log will only happen once button is clicked
    
    //public $listeners = ['moreProducts'];
    public function mount(){
        
        //$this->products = Firework::orderByRaw('CONVERT(price, SIGNED)')->forPage($this->current_page,$this->products_on_page)->get();
        $this->products = Firework::forPage($this->current_page, $this->products_on_page)->get();
        //dd($this->products);
        
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
                    : 0;

        if((int)$qty){
            $cartItem = Cart::add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => (int)$qty,
                    'price' => $product->price,
                    'options'=>['type'=>'product']
                ])->associate('Firework');
        }else {
            // the quantity in this order is greater than stock
        }
        $this->emitTo('shopping-cart','cart-updated');
    }

    public function moreProducts(){
        $this->current_page += 1;
        $new_products = Firework::forPage($this->current_page,$this->products_on_page)->get();

        // check length of new_products
        // if length is 0 then more_products button should be disabled
        if(! $new_products->count()){
            $this->has_more_products = false;
        }
        foreach($new_products as $product){
            $this->quantity[$product->id] = 1;
            $this->stock[$product->id] = $product->stock;
        }

        $this->products = $this->products -> merge($new_products);

        // log the number of times the user has clicked the button
        $this->num_button_clicked ++;
        // implement basic logging here
        Log::info('User clicked to see more products',['n:'=>$this->num_button_clicked]);
    }

    /* Implement sorting feature */
    
}

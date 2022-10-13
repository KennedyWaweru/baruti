<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Gloudemans\Shoppingcart\Cart;


class ProductCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $quantity;
    public $cartContent;
    public $stock;
    public function __construct(Cart $cart)
    {
        //
        $this->cart = $cart;
        $this->cartContent = $cart->content();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.product-card');
    }
}

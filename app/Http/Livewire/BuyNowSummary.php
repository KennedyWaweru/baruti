<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Package;

class BuyNowSummary extends Component
{
    public $package;
    public $item_slug;
    public function mount(){
        $this->package = Package::where('slug',$this->item_slug);
    }
    public function render()
    {
        return view('livewire.buy-now-summary');
    }
}

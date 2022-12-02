<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Package;

class BuyNowSummary extends Component
{
    public $package;
    public function render()
    {
        return view('livewire.buy-now-summary');
    }
}

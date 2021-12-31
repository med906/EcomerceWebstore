<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\searchFor;
use Livewire\Component;

class ProductGalleryComponent extends Component
{
    public $images;
    public $product;
    public function mount(){
        $product_slug = searchFor::select('product_slug')->get()->toArray();
        $this->product = Product::where('slug',$product_slug[0]['product_slug'])->first();
        $this->images =  explode(",",$this->product->images);
        $this->images[] = $this->product->image;


    }
    public function render()
    {
        return view('livewire.product-gallery-component');
    }
}

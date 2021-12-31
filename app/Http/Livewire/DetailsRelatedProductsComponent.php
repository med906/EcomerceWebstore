<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\searchFor;
use Livewire\Component;

class DetailsRelatedProductsComponent extends Component
{
    public $related_products;
    public $product;

    public function mount(){
        $product_slug = searchFor::select('product_slug')->get()->toArray();
        $this->product = Product::where('slug',$product_slug[0]['product_slug'])->first();
        $this->related_products = Product::where('category_id',$this->product->category_id)->inRandomOrder()->limit(5)->get();


    }

    public function render()
    {

        return view('livewire.details-related-products-component');
    }
}

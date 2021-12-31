<?php

namespace App\Http\Livewire;

use App\Models\Headers;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Category;

class ShopComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pageSize;

    public $inMinPrice;
    public $inMaxPrice;

    public $minPrice = 0;
    public $maxPrice = 99999999;

    public $shopPageHeader;

    public function mount(){

        $this->sorting = "default";
        $this->pageSize = 12;

        $this->shopPageHeader = Headers::where('type','ShopHeader')->where('status',1)->first();
        if ($this->shopPageHeader){
            $this->shopPageHeader = $this->shopPageHeader->image;
        }

    }
    public function store($product_id,$product_name,$product_price){

        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added to cart');
        $this->emitTo('cart-count-component','refreshComponent');
        return redirect()->route('product.cart');

    }

    public function addToWishList($product_id,$product_name,$product_price){

        if(!Cart::instance('wishlist')->content()->where('id',$product_id)->first()){
            Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
            $this->emitTo('wish-list-count-component','refreshComponent');
        }

    }

    public function removeFromWishList($product_id){

        foreach (Cart::instance('wishlist')->content() as $wItem) {

            if( $wItem->id == $product_id){
                Cart::instance('wishlist')->remove($wItem->rowId);
                $this->emitTo('wish-list-count-component','refreshComponent');
                return;
            }
        }
    }



    public function applyCurrentFiler(){
        if ($this->inMaxPrice == 0 or $this->inMaxPrice == null){
            $this->inMaxPrice = $this->maxPrice;
        } else {
            $this->maxPrice = 99999999;
        }
        if ($this->inMinPrice == 0 or $this->inMinPrice == null){
            $this->minPrice = 0;
        } else {
            $this->minPrice = $this->inMaxPrice;
        }

    }



    public function render()
    {


        if ($this->sorting=='date')
        {
//          whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->
            $products = Product::whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else if ($this->sorting=='price')
        {
            $products = Product::whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if ($this->sorting=='price-desc')
        {
            $products = Product::whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->orderBy('regular_price','DESC')->paginate($this->pageSize);
        } else{
            $products = Product::whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->paginate($this->pageSize);
        }


        $sale = Sale::find(1);
        $Categories = Category::all();

        return view('livewire.shop-component',['products'=>$products,'Categories'=>$Categories,'sale'=>$sale])->layout('layouts.base');
    }
}

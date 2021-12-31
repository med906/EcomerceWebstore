<?php

namespace App\Http\Livewire;

use App\Models\Headers;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Category;

class SearchComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pageSize;

    public $search;
    public $product_cat;
    public $product_cat_id;

    public $inMinPrice;
    public $inMaxPrice;

    public $minPrice = 0;
    public $maxPrice = 99999999;

    public $shopPageHeader;


    public function mount(){

        $this->sorting = "default";
        $this->pageSize = 12;
        $this->fill(request()->only('search','product_cat','product_cat_id'));

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


    public function render()
    {


        if ($this->sorting=='date')
        {
            $products = Product::whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else if ($this->sorting=='price')
        {
            $products = Product::whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if ($this->sorting=='price-desc')
        {
            $products = Product::whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','DESC')->paginate($this->pageSize);
        } else{
            $products = Product::whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate($this->pageSize);
        }

        $Categories = Category::all();
        $sale = Sale::find(1);


        return view('livewire.search-component',['products'=>$products,'sale'=>$sale,'Categories'=>$Categories])->layout('layouts.base');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Headers;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Category;

class CategoryComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pageSize;
    public $category_slug;

    public $inMinPrice;
    public $inMaxPrice;

    public $minPrice = 0;
    public $maxPrice = 99999999;
    public $category_id;

    public $shopPageHeader;


    public function mount($category_slug){

        $this->sorting = "default";
        $this->pageSize = 12;
        $this->category_slug = $category_slug;

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
        $category = Category::where('slug',$this->category_slug)->first();
        $this->category_id = $category->id;
        $category_name = $category->name;
        if ($this->sorting=='date')
        {

            $products = Product::query()->when('sale_price'>0, function ($query){
                $query->Where('category_id',$this->category_id)->whereBetween('sale_price',[$this->minPrice,$this->maxPrice])->orderBy('created_at','DESC');

            })->when('sale_price'==0,function ($query){
                $query->Where('category_id',$this->category_id)->whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->orderBy('created_at','DESC');

            });
            $products = $products->paginate($this->pageSize);
        }
        else if ($this->sorting=='price')
        {

            $products = Product::query()->when('sale_price'>0, function ($query){
                $query->Where('category_id',$this->category_id)->whereBetween('sale_price',[$this->minPrice,$this->maxPrice])->orderBy('regular_price','ASC');

            })->when('sale_price'==0,function ($query){
                $query->Where('category_id',$this->category_id)->whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->orderBy('regular_price','ASC');

            });
            $products = $products->paginate($this->pageSize);

//
        }
        else if ($this->sorting=='price-desc')
        {

            $products = Product::query()->when('sale_price'>0, function ($query){
                $query->Where('category_id',$this->category_id)->whereBetween('sale_price',[$this->minPrice,$this->maxPrice])->orderBy('sale_price','DESC');

            })->when('sale_price'==0,function ($query){
                $query->Where('category_id',$this->category_id)->whereBetween('regular_price',[$this->minPrice,$this->maxPrice])->orderBy('regular_price','DESC');;

            });
            $products = $products->paginate($this->pageSize);

        } else{
            $products = Product::query()->when('sale_price'>0, function ($query){
                $query->Where('category_id',$this->category_id)->whereBetween('sale_price',[$this->minPrice,$this->maxPrice]);

            })->when('sale_price'==0,function ($query){
                $query->Where('category_id',$this->category_id)->whereBetween('regular_price',[$this->minPrice,$this->maxPrice]);

            });
            $products = $products->paginate($this->pageSize);
//            dd($products);

        }
        $sale = Sale::find(1);
        $Categories = Category::all();

        return view('livewire.category-component',['products'=>$products,'Categories'=>$Categories,'sale'=>$sale,'category_name'=>$category_name])->layout('layouts.base');
    }
}

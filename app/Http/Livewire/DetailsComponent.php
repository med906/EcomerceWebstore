<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\Sale;
use App\Models\searchFor;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $slug;
    public $qty = 1;


    public $rating = 0;
    public $reviews;
    public $isUp;
    public $popular_products;
    public $related_products;

    public $maxReviews = 2;
    public $images;



    public function mount($slug){
        $this->slug = $slug;


        $product = Product::where('slug',$this->slug)->first();
        $this->images =  explode(",",$product->images);
        $this->images[] = $product->image;
        $search = searchFor::find(1);
        if($search){
            $search->product_slug = $this->slug;
            $search->save();
        } else {
            $search = new searchFor();
            $search->product_slug = $this->slug;
            $search->save();
        }




    }


    public function increaseQuantity(){
        $product = Product::where('slug',$this->slug)->first();
        if ($product->quantity >= $this->qty + 1 ){
            $this->qty+=1;
        }


    }

    public function decreaseQuantity(){
        if($this->qty >0){
            $this->qty-=1;
        }
    }

    public function store($product_id,$product_name,$product_price){
        if ($this->qty > 0){
            Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price)->associate('App\Models\Product');
            session()->flash('success_message','Item added to cart');
            return redirect()->route('product.cart');
        }


    }

    public function addToWishList($product_id,$product_name,$product_price){

        if(!Cart::instance('wishlist')->content()->where('id',$product_id)->first()){
            Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
            $this->emitTo('wish-list-count-component','refreshComponent');
        }

    }


    public function render()
    {

        $product = Product::where('slug',$this->slug)->first();

        if ($product->ratersCount > 0){
            $this->rating =(integer) $product->ratingSum/$product->ratersCount;
            $this->reviews = DB::table('reviews')->where('product_id',$product->id)->get();
            if ($this->reviews->count() < 10){
                $this->maxReviews =$this->reviews->count();
            } else {
                $this->maxReviews = 10;
            }
//            dd($this->reviews->count());
        }
        $sale = Sale::find(1);


        if(!$this->isUp){

            $this->popular_products = Product::inRandomOrder()->limit(4)->get();

        }
        $this->isUp = 1;
//        if ($sale){
//            return view('livewire.details-component',['maxReviews'=>$this->maxReviews,'reviews'=>$this->reviews,'rating'=>$this->rating,'sale'=>$sale,'product'=>$product,'popular_products'=>$this->popular_products,'related_products'=>$this->related_products])->layout('layouts.base');
//        }
        return view('livewire.details-component',['maxReviews'=>$this->maxReviews,'reviews'=>$this->reviews,'rating'=>$this->rating,'sale'=>$sale,'product'=>$product,'popular_products'=>$this->popular_products])->layout('layouts.base');

    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    public $price;


    public function increaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        if($product->quantity >= $product->qty+1){
            $qty = $product->qty+1;
            Cart::instance('cart')->update($rowId,$qty);
            $this->emitTo('cart-count-component','refreshComponent');
        }

    }

    public function decreaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty-1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function destroy($rowId){
        Cart::instance('cart')->remove($rowId);
        session()->flash('success_message','Item has been removed');
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function switchToSaveForLater($rowId){
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message','Item saved for later');
    }

    public function moveToCart($rowId){
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('s_success_message','Item moved to cart');
    }

    public function deleteFromSaveForLater($rowId){
        Cart::instance('saveForLater')->remove($rowId);
        session()->flash('s_success_message','Item has been removed from save for later');


    }

    public function destroyAll(){
        Cart::instance('cart')->destroy();
        session()->flash('success_message','Cart has been Cleared');
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function calculateRowPrice($rowId){

    }



    public function checkout(){

        if (Auth::check()){
            return redirect()->route('checkout');
        } else {
            return redirect()->route('login');
        }
    }

    public function setAmountForCheckout(){
        session()->put('checkout',[
            'total'=>Cart::instance()->total()
            ]
        );
    }

    public function render()
    {

        $sale = Sale::find(1);
        if ($sale){
            foreach (Cart::instance('cart')->content() as $item){

                if ($item->model->sale_price > 0){
                    $item->price = $item->model->sale_price;
                }
            }
        }
        $this->setAmountForCheckout();
        if ($sale){
            return view('livewire.cart-component',['sale'=>$sale])->layout('layouts.base');
        }
        return view('livewire.cart-component')->layout('layouts.base');

    }
}

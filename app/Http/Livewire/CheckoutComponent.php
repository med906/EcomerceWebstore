<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $lastName;
    public $firstName;
    public $emailAddress;
    public $phoneNumber;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country;
    public $zipCode;
    public $paymentMode;
    public $thankYou = 0;

    public function updated($filed){
        $this->validateOnly($filed,[
            'lastName' => 'required',
            'firstName' => 'required',
            'emailAddress' => 'required|email',
            'phoneNumber' => 'required|numeric',
            'line1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'zipCode' => 'required',
            'paymentMode' => 'required'
        ]);

    }

    public function placeOrder(){



        $this->validate([
              'lastName' => 'required',
              'firstName' => 'required',
              'emailAddress' => 'required|email',
              'phoneNumber' => 'required|numeric',
              'line1' => 'required',
              'city' => 'required',
              'province' => 'required',
              'country' => 'required',
              'zipCode' => 'required',
              'paymentMode' => 'required'
        ]);


        $order = new Order();
        $order->user_id = Auth::user()->id;
//        dd(Cart::instance('cart')->subtotal,$order->user_id);
        $order->total = (float)Cart::instance('cart')->subtotal;
        $order->lastName = $this->lastName;
        $order->firstName = $this->firstName;
        $order->email = $this->emailAddress;
        $order->number = $this->phoneNumber;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->zipCode = $this->zipCode;
        $order->is_shipping_different = false;
        $order->save();

        foreach (Cart::instance('cart')->content() as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();

        }

        if ($this->paymentMode == 'cod'){
            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->order_id = $order->id;
            $transaction->mode = 'cod';
            $transaction->status = 'pending';
            $transaction->save();
        }
        $this->thankYou = 1;

        Cart::instance('cart')->destroy();
        session()->forget('checkout');


    }

    public function verifyCheckout(){

        if (!Auth::check()){
            return redirect()->route('login');
        }else if($this->thankYou){
            return redirect()->route('thankYou');

        } else if (Cart::instance('cart')->count()<1){
            return redirect()->route('product.cart');
        }

    }


    public function render()
    {
        $this->verifyCheckout();
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}

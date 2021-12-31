<?php

namespace App\Http\Livewire\User;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Livewire\Component;

class UserReviewComponent extends Component
{
    public $order_item_id;
    public $rating;
    public $comment;



    public function mount($order_item_id){
        $this->order_item_id = $order_item_id;
    }

    public function updated($filed)
    {
        $this->validateOnly($filed,[
            'rating' =>'required',
            'comment'=>'required'
        ]);
    }

    public function addReview(){
        $this->validate([
            'rating'=>'required',
            'comment'=>'required'
        ]);
        $orderItem = OrderItem::find($this->order_item_id);

        if (!$orderItem->rstatus ){
            $review = new Review();
            $review->rating = $this->rating;
            $review->comment = $this->comment;
            $review->order_item_id = $this->order_item_id;

            $product = Product::find($orderItem->product_id);


            $product->ratersCount +=1;
            $product->ratingSum +=$this->rating;
            $review->product_id = $product->id;
            $orderItem->rstatus = true;

            $product->save();
            $review->save();
            $orderItem->save();
            session()->flash('message','review has been added successfully');
        } else {
            session()->flash('message','your review has already been added!');
        }

    }

    public function render()
    {
        $orderedItems = OrderItem::find($this->order_item_id);
        return view('livewire.user.user-review-component',['orderedItems'=>$orderedItems])->layout('layouts.base');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminOrderComponent extends Component
{
    public $name;
    public $inName;
    public $filter = "email";
    public $inFilter = "email";

    public function updateOrderStatus($order_id,$status){
        $order = Order::find($order_id);
        $orderItem = OrderItem::find($order_id);
        $order->status = $status;
        if ($status == 'delivered'){
            $order->delivered_date = DB::raw('CURRENT_DATE');
            $orderItem->dDate = DB::raw('CURRENT_DATE');

            $orderItem->dStatus = true;
//            dd($orderItem->dStatus);
        }
        else if($status == 'canceled'){
            $order->canceled_date = DB::raw('CURRENT_DATE');
        }
        $orderItem->save();
        $order->save();
        session()->flash('order_message','order status has been updated');
    }

    public function searchForOrder(){

        $this->name = $this->inName;
        $this->filter = $this->inFilter;


    }

    public function render()
    {
        if (!$this->name){
            $orders = Order::orderBy('created_at','DESC')->paginate(12);
        } else {

            $orders = Order::where($this->filter,'like','%'.$this->name.'%')->orderBy('created_at','DESC')->paginate(12);
        }

        return view('livewire.admin.admin-order-component',['orders'=>$orders])->layout('layouts.base');
    }
}

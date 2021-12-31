<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\searchFor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminChartsComponent extends Component
{
    public function render()
    {

//        $users = Product::select(DB::raw("COUNT(*) as count"))
//            ->whereYear('category_id',date('Y'))
//            ->groupBy(DB::raw("Month(created_at)"))->count();
//
//        $months = User::select(DB::raw("Month(created_at) as month"))
//            ->whereYear('created_at',date('Y'))
//            ->groupBy(DB::raw("Month(created_at)"))->count();
//
//        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);

//        foreach ($months as $index=>$month){
//            $datas[$month] = $users[$index];
//        }


//        dd($users,$months);

        //        $soldAmount = [];
//
//        foreach ($deliveredId as $id){
//            $soldAmount[] = OrderItem::select('quantity')->where('order_id',$id)->where('product_id',1)->get()->toArray()[0];
//        }


//        $users = Product::select('category_id')->get()->toArray();
////        $data = json_decode(json_encode($users), true);
//
//        $users = Product::select('category_id')->get()->toArray();
//        $data = [];
//        foreach ($users as $user => $id){
//            $data[] = $id['category_id'];
//        }
//        dd($data);



//        $dates = OrderItem::select('dDate')->where('dStatus',1)->where('product_id',1)->get()->toArray();
//        $quantity = OrderItem::select('quantity')->where('dStatus',1)->where('product_id',1)->get()->toArray();
//
//        $datesArray = [];
//        $quantitiesArray = [];
//
//        foreach ($dates as $date => $dat){
//            $datesArray[] = $dat['dDate'];
//        }
//
//        foreach ($quantity as $amount => $qua){
//            $quantitiesArray[] = $qua['quantity'];
//        }
//
//        dd($datesArray,$quantitiesArray);

//        $product_id = searchFor::select('keyWord')->get()->toArray();
//        dd($product_id[0]['keyWord']);
        $product_id = searchFor::select('keyWord')->get()->toArray();


        $dates = OrderItem::select('dDate')->where('dStatus',1)->where('product_id',$product_id[0]['keyWord'])->get()->toArray();
        $quantity = OrderItem::select('quantity')->where('dStatus',1)->where('product_id',$product_id[0]['keyWord'])->get()->toArray();

        $datesArray = [];
        $quantitiesArray = [];

        foreach ($dates as $date => $dat){
            $datesArray[] = $dat['dDate'];
        }

        foreach ($quantity as $amount => $qua){
            $quantitiesArray[] = $qua['quantity'];
        }
//        dd($product_id[0]['keyWord'],$dates,$quantity);

        return view('livewire.admin-charts-component')->layout('layouts.base');
    }
}

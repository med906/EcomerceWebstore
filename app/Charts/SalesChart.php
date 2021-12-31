<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\searchFor;
use App\Models\User;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class SalesChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */



    public function handler(Request $request): Chartisan
    {

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

//        dd($product_id);




//        $users = DB::select('select count(name) from users group by (DB::)');
        return Chartisan::build()
            ->labels($datesArray)
            ->dataset('sales', $quantitiesArray);


//            ->labels(['First', 'Second', 'Third'])
//            ->dataset('Sample', [10, 2, 3])
//            ->dataset('Sample 2', [5, 20, 1]);
    }
}

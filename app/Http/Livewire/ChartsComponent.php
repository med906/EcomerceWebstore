<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartsComponent extends Component
{
    public function render()
    {

//        $users = User::select(DB::raw("COUNT(*) as count"))
//            ->whereYear('created_at',date('Y'))
//            ->groupBy(DB::raw("Month(created_at)"));
////            ->pluck('count');
//
//        $months = User::select(DB::raw("Month(created_at) as month"))
//            ->whereYear('created_at',date('Y'))
//            ->groupBy(DB::raw("Month(created_at)"));
////            ->pluck('count');
//
//        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
//
//        foreach ($months as $index=>$month){
//            $datas[$month] = $users[$index];
//        }
//        ,compact('datas')
        return view('livewire.charts-component');
    }
}

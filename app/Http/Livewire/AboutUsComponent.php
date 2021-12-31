<?php

namespace App\Http\Livewire;

use App\Models\aboutUs;
use App\Models\Team;
use Livewire\Component;

class AboutUsComponent extends Component
{


    public function render()
    {
        $info = aboutUs::find(1);
        $team = Team::paginate(team::count());

        return view('livewire.about-us-component',['info'=>$info,'team'=>$team])->layout('layouts.base');
    }
}

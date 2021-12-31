<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class AdminTeamComponent extends Component
{

    public function removeMember($id){

        $members = Team::find($id);
        $members->delete();
        session()->flash('message','Team Member has been removed successfully');

    }

    public function render()
    {
        $team = Team::paginate(10);
        return view('livewire.admin-team-component',['team'=>$team])->layout('layouts.base');
    }
}

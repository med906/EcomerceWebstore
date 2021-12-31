<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddTeamComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $title;
    public $image;
    public $description;


    public function addMember(){

        $this->validate([
            'name'=>'required',
            'title'=>'required',
            'image' => 'required|mimes:jpeg,png',
            'description'=>'required'

        ]);
        $team = new Team();
        $team->name = $this->name;
        $team->title = $this->title;
        $team->teamDescription = $this->description;

        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('members',$imageName);
        $team->image = $imageName;

        $team->save();
        session()->flash('message','team member has been added successfully');




    }

    public function render()
    {
        return view('livewire.admin-add-team-component')->layout('layouts.base');
    }
}

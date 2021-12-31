<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditTeamComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $title;
    public $image;
    public $description;
    public $newImage;
    public $memberId;

    public function mount($team_id){

        $member = Team::find($team_id);
        $this->name = $member->name;
        $this->title = $member->title;
        $this->image = $member->image;
        $this->memberId = $member->id;
        $this->description = $member->teamDescription;

    }

    public function updated($fields){

        $this->validateOnly($fields,[
            'name'=>'required',
            'title'=>'required',
            'newImage' => 'required_without:image',
            'description'=>'required'
        ]);
    }

    public function updateMember(){
        $this->validate([
            'name'=>'required',
            'title'=>'required',
            'newImage' => 'required_without:image',
            'description'=>'required'
        ]);

        $member = Team::find($this->memberId);
        $member->name = $this->name;
        $member->title = $this->title;
        $member->teamDescription = $this->description;

        if ($this->newImage){

            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('members',$imageName);
            $member->image = $imageName;
        }

        $member->save();
        session()->flash('message','team member information has been updated successfully');

    }

    public function render()
    {
        return view('livewire.admin-edit-team-component')->layout('layouts.base');
    }
}

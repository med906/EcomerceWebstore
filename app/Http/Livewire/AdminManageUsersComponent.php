<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AdminManageUsersComponent extends Component
{

    public $name;
    public $inName;
    public $filter = "email";
    public $inFilter = "email";

    public function updateStatus($user_id,$status){
        $users = User::find($user_id);
        $users->allowed = $status;
        $users->save();
        session()->flash('message','user status has been updated');
    }

    public function searchForUser(){
        $this->name = $this->inName;
        $this->filter = $this->inFilter;

    }

    public function render()
    {
        if (!$this->name){
            $users = User::orderBy('created_at','DESC')->paginate(12);
        } else {
            $users = User::where($this->filter,'like','%'.$this->name.'%')->orderBy('created_at','DESC')->paginate(12);
        }

        return view('livewire.admin-manage-users-component',['users'=>$users])->layout('layouts.base');
    }
}

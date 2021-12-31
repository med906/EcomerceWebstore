<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfileSettingComponent extends Component
{
    Use WithFileUploads;

    public $name;
    public $email;
    public $newImage;
    public $image;

    public $hasImage;

    public function mount(){
        $user = User::where('id',Auth::user()->id)->first();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->profile_photo_path;
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'email'=>'required|email',
            'newImage'=>'required_without:image'
        ]);
    }



    public function updateProfile(){

        $this->validate([
            'name'=>'required',
            'email'=>'required|email',
            'newImage'=>'required_without:image'
        ]);

        $user = User::where('id',Auth::user()->id)->first();
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->newImage){

            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('Users',$imageName);
            $user->profile_photo_path = $imageName;

        }
        $user->save();
        session()->flash('message','Profile has been Updated successfully!');

    }

    public function render()
    {
        return view('livewire.user-profile-setting-component')->layout('layouts.base');
    }
}

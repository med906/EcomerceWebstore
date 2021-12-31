<?php

namespace App\Http\Livewire;

use App\Models\aboutUs;
use Livewire\Component;

class AdminAboutUsComponent extends Component
{

    public $title;
    public $description;
    

    public function mount(){
        $info = aboutUs::find(1);

        if ($info){
            $this->title = $info->title;
            $this->description = $info->companyInfo;
        }
    }

    public function updateInfo(){
        $info = aboutUs::find(1);

        if ($info){
            $info->title = $this->title;
            $info->companyInfo = $this->description;
            $info->save();
            session()->flash('message','about us page has been updated successfully');
        } else {
            $info = new aboutUs();
            $info->title = $this->title;
            $info->companyInfo = $this->description;
            $info->save();
            session()->flash('message','about us page has been created successfully');
        }
    }

    public function render()
    {
        return view('livewire.admin-about-us-component')->layout('layouts.base');
    }
}

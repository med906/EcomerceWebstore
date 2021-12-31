<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SignupMailComponent extends Component
{
    public $email_data;

    public function mount($data){
        $this->email_data = $data;
    }


    public function render()
    {
        return view('livewire.signup-mail-component',['email_data'=>$this->email_data])->layout('layouts.base');
    }
}

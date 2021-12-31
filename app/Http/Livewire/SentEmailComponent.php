<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SentEmailComponent extends Component
{


    public function render()
    {
        return view('livewire.sent-email-component')->layout('layouts.base');
    }
}

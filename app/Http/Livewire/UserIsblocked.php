<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserIsblocked extends Component
{
    public function render()
    {
        if (Auth::user()){
            return redirect(\App\Providers\RouteServiceProvider::HOME);
        }
        return view('livewire.user-isblocked')->layout('layouts.base');

    }
}

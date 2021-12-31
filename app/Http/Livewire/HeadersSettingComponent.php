<?php

namespace App\Http\Livewire;

use App\Models\Headers;
use Livewire\Component;

class HeadersSettingComponent extends Component
{

    public function deleteHeader($id){

        $headers = Headers::find($id);
        $headers->delete();
        session()->flash('message','Header has been deleted successfully');
    }
    public function render()
    {
        $headers = Headers::paginate(10);
        return view('livewire.headers-setting-component',['headers'=>$headers])->layout('layouts.base');
    }
}

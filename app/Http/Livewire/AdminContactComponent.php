<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class AdminContactComponent extends Component
{

    public $name;
    public $inName;
    public $filter = "email";
    public $inFilter = "email";

    public function searchForMessage(){

        $this->name = $this->inName;
        $this->filter = $this->inFilter;


    }

    public function render()
    {
        if (!$this->name){
            $contacts = Contact::orderBy('created_at','DESC')->paginate(12);
        } else {

            $contacts = Contact::where($this->filter,'like','%'.$this->name.'%')->orderBy('created_at','DESC')->paginate(12);
        }

        return view('livewire.admin-contact-component',['contacts'=>$contacts])->layout('layouts.base');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Headers;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditHeaderComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $image;
    public $status;
    public $place;
    public $url;
    public $newImage;
    public $Hid;

    public function mount($header_id){
        $header = Headers::find($header_id);
        $this->name = $header->name;
        $this->image = $header->image;
        $this->status = $header->status;
        $this->place = $header->type;
        $this->url = $header->url;
        $this->Hid = $header_id;

    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required|string',
            'status'=>'required',
            'place'=>'required|min:1',
            'url'=>'required|string',
            'newImage'=>'required_without:image'
        ]);
    }


    public function updateHeader(){

        $this->validate([
            'name'=>'required|string',
            'status'=>'required',
            'place'=>'required|min:1',
            'url'=>'required|string',
            'newImage'=>'required_without:image'
        ]);
        $header = Headers::find($this->Hid);
        $header->name = $this->name;
        $header->status = $this->status;
        $header->type = $this->place;
        $header->url = $this->url;

        if ($this->newImage){

            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('headers',$imageName);
            $header->image = $imageName;

        }

        if($header->status){
            $tmp = Headers::where('type',$this->place)->where('status',1)->where('id','<>',$header->id)->first();
            if ($tmp){
                $tmp->status = 0;
                $tmp->save();
            }

        }

        $header->save();
        session()->flash('message','header has been updated successfully');

    }

    public function render()
    {
        return view('livewire.edit-header-component')->layout('layouts.base');
    }
}

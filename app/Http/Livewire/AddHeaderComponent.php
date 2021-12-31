<?php

namespace App\Http\Livewire;

use App\Models\Headers;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddHeaderComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $image;
    public $status = 0;
    public $place;
    public $url;

    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required|string',
            'status'=>'required',
            'place'=>'required|min:1',
            'url'=>'required|string',
            'image'=>'required'
        ]);
    }

    public function storeHeader(){

        $this->validate([
            'name'=>'required|string',
            'status'=>'required',
            'place'=>'required|min:1',
            'url'=>'required|string',
            'image'=>'required'
        ]);
        $header = new Headers();
        $header->name = $this->name;
        $header->status = $this->status;
        $header->type = $this->place;
        $header->url = $this->url;

        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('headers',$imageName);
        $header->image = $imageName;

        if($header->status){
            $tmp = Headers::where('type',$this->place)->where('status',1)->where('id','<>',$header->id)->first();
            if ($tmp){
                $tmp->status = 0;
                $tmp->save();
            }

        }

        $header->save();



        session()->flash('message','header has been added successfully');

    }



    public function render()
    {
        $headers = Headers::paginate(5);

        return view('livewire.add-header-component',['headers'=>$headers])->layout('layouts.base');
    }
}

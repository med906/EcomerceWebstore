<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $image;
    public $price;
    public $link;
    public $status;

    public function mount(){
        $this->status = 0;
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'title'=>'required|string',
            'subtitle'=>'required|string',
            'price'=>'required|numeric',
            'status'=>'required|numeric',
            'image'=>'required'
        ]);

    }

    public function addSlide(){
        $this->validate([
           'title'=>'required|string',
           'subtitle'=>'required|string',
           'price'=>'required|numeric',
           'status'=>'required|numeric',
            'image'=>'required'

        ]);
        $slider = new HomeSlider();

        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;

        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('sliders',$imageName);
        $slider->image = $imageName;

        $slider->save();
        session()->flash('message','Slide has been created successfully');

    }

    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');
    }
}

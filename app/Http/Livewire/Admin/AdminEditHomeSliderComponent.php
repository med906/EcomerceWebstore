<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditHomeSliderComponent extends Component
{

    use WithFileUploads;
    public $title;
    public $subtitle;
    public $image;
    public $price;
    public $link;
    public $status;
    public $newImage;
    public $slide_id;

    public function mount($slide_id){
        $slider = HomeSlider::find($slide_id);
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->status = $slider->status;
        $this->image = $slider->image;
        $this->slide_id = $slide_id;

    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'title'=>'required|string',
            'subtitle'=>'required|string',
            'price'=>'required|numeric',
            'status'=>'required|numeric',
            'newImage'=>'required_without:image'
        ]);



    }

    public function updateSlide(){

        $this->validate([
            'title'=>'required|string',
            'subtitle'=>'required|string',
            'price'=>'required|numeric',
            'status'=>'required|numeric',
            'newImage'=>'required_without:image'
        ]);

        $slider = HomeSlider::find($this->slide_id);

        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;

        if ($this->newImage)
        {
            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs("sliders",$imageName);
            $slider->image = $imageName;
        }

        $slider->save();
        session()->flash('message','Slide has been Update Successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');
    }
}

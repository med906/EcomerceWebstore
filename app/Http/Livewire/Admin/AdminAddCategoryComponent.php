<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function updated($filed){
        $this->validateOnly($filed,[
            'name'=>'required',
            'slug'=>'required|unique:categories'
        ]);

    }

    public function storeCategory(){
        $this->validate(
            [
                'name'=>'required',
                'slug'=>'required|unique:categories'
            ]

        );
        $categories = new Category();
        $categories->name = $this->name;
        $categories->slug = $this->slug;
        $categories->save();
        session()->flash('message','Category has been created successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}

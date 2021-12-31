<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminEditCategoryComponent extends Component
{
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;

    public function mount($category_slug){
        $this->category_slug = $category_slug;
        $category = Category::Where('slug',$category_slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function updated($filed){
        $this->validateOnly($filed,[
            'name'=>'required',
            'slug'=>'required|unique:categories'
        ]);

    }

    public function updateCategory(){
        $this->validate(
            [
                'name'=>'required',
                'slug'=>'required|unique:categories'
            ]

        );
        $categories = Category::find($this->category_id);
        $categories->name = $this->name;
        $categories->slug = $this->slug;
        $categories->save();
        session()->flash('message','Category has been updated successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}

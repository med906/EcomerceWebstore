<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories = [];
    public $numberOfProducts;

    public function mount(){
        $category = HomeCategory::find(1);
        if ($category){
            $this->selected_categories = explode(',',$category->sel_categories);
            $this->numberOfProducts = $category->number_of_products;
        }


    }

    public function updateHomeCategories(){
        $categories = HomeCategory::find(1);
        if ($categories){
            $categories->sel_categories = implode(',',$this->selected_categories);
            $categories->number_of_products = $this->numberOfProducts;
            $categories->save();
            session()->flash('message','Home Categories has been Update successfully');
        } else {
            $categories = New HomeCategory();
            $categories->sel_categories = implode(',',$this->selected_categories);
            $categories->number_of_products = $this->numberOfProducts;
            $categories->save();
            session()->flash('message','Home Categories has been Created successfully');
        }


    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}

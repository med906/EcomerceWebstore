<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Headers;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public $setup = 1;
    public $leftSlide;
    public $rightSlide;
    public $latestProducts;
    public $productsCategories;

    public function mount(){

        $this->leftSlide = Headers::where('type','leftSlide')->where('status',1)->first();
        if ($this->leftSlide){
            $this->leftSlide = $this->leftSlide->image;
        }
        $this->rightSlide = Headers::where('type','RightSlide')->where('status',1)->first();
        if ($this->rightSlide){
            $this->rightSlide = $this->rightSlide->image;
        }
        $this->latestProducts = Headers::where('type','LatestProducts')->where('status',1)->first();
        if ($this->latestProducts){
            $this->latestProducts = $this->latestProducts->image;
        }
        $this->productsCategories = Headers::where('type','ProductCategory')->where('status',1)->first();
        if ($this->productsCategories){
            $this->productsCategories = $this->productsCategories->image;
        }

    }

    public function render()
    {


        $sliders = HomeSlider::where('status',1)->get();
        $lProducts = Product::orderBy("created_at","DESC")->get()->take(8);
        $category =HomeCategory::find(1);
        $sProducts = Product::where("sale_price",'>',0)->inRandomOrder()->get()->take(8);

        $sale = Sale::find(1);
        if ($category){
            $cats= explode(',',$category->sel_categories);
            $categories = Category::whereIn('id',$cats)->get();
            $numberOfPros = $category->number_of_products;
            if ($sale){
                return view('livewire.home-component',['setup'=>$this->setup,'sale'=>$sale,'sProducts'=>$sProducts,'sliders'=>$sliders,'lProducts'=>$lProducts,'categories'=>$categories,'nProducts'=>$numberOfPros])->layout('layouts.base');
            }
            return view('livewire.home-component',['setup'=>$this->setup,'sale'=>$sale,'sProducts'=>$sProducts,'sliders'=>$sliders,'lProducts'=>$lProducts,'categories'=>$categories,'nProducts'=>$numberOfPros])->layout('layouts.base');

        }
        if ($sale){
            $categories = [];
            return view('livewire.home-component',['setup'=>$this->setup,'sale'=>$sale,'sProducts'=>$sProducts,'sliders'=>$sliders,'lProducts'=>$lProducts,'categories'=>$categories])->layout('layouts.base');
        }

        $categories = [];
        return view('livewire.home-component',['setup'=>$this->setup,'sProducts'=>$sProducts,'sliders'=>$sliders,'lProducts'=>$lProducts,'categories'=>$categories])->layout('layouts.base');

    }
}

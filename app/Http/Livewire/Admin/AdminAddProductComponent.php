<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $description;
    public $short_description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $quantity;
    public $expiryDate;
    public $stock_status;
    public $featured;
    public $image;
    public $category_id;
    public $images;

    public function mount(){
        $this->stock_status = "instock";
        $this->featured = '0';
    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name,'-');
    }

    public function updated($fields){
        $this->validateOnly($fields,[
             'name' => 'required',
             'slug' => 'required|unique:products',
             'description' => 'required',
             'short_description' => 'required',
             'regular_price' => 'required|numeric',
             'sale_price' => 'numeric',
             'sku' => 'required',
             'quantity' => 'required|numeric',
             'stock_status' => 'required',
             'image' => 'required|mimes:jpeg,png',
            'images' => 'required',
             'category_id' => 'required'
        ]);

    }

    public function addProduct(){

        $this->validate(
            [
                'name' => 'required',
                'slug' => 'required|unique:products',
                'description' => 'required',
                'short_description' => 'required',
                'regular_price' => 'required|numeric',
                'sale_price' => 'numeric',
                'sku' => 'required',
                'quantity' => 'required|numeric',
                'stock_status' => 'required',
                'image' => 'required|mimes:jpeg,png',
                'images' => 'required',
                'category_id' => 'required'
            ]

        );

        $product = new Product();

        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->short_description = $this->short_description;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->quantity = $this->quantity;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->category_id = $this->category_id;
        $product->expiryDate = $this->expiryDate;

        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('products',$imageName);
        $product->image = $imageName;

        if ($this->images){
            $imagesName = "";
            foreach ($this->images as $key=>$image){
                $imgName = Carbon::now()->timestamp. $key. '.'.$image->extension();
                $image->storeAs('products',$imgName);
                $imagesName = $imagesName . ',' . $imgName;
            }
            $product->images = $imagesName;
        }

        $product->save();

        session()->flash('message','Product has been created successfully!');



    }


    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-product-component',['categories'=>$categories])->layout('layouts.base');
    }
}

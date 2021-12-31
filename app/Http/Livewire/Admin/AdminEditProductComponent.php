<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
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
    public $stock_status;
    public $featured;
    public $image;
    public $category_id;
    public $newImage;
    public $product_id;
    public $expiryDate;
    public $images;
    public $newImages;


    public function mount($product_slug){

        $product = Product::where('slug',$product_slug)->first();

        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->short_description = $product->short_description;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->SKU;
        $this->quantity = $product->quantity;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->category_id = $product->category_id;
        $this->image = $product->image;
        $this->product_id = $product->id;
        $this->expiryDate = $product->expiryDate;
        $this->images = $product->images;

    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name,'-');
    }

    public function updated($filed){
        $this->validateOnly($filed,[
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'sku' => 'required',
            'quantity' => 'required|numeric',
            'stock_status' => 'required',
            'newImage' => 'required_without:image',
            'newImages'=>'required_without:images',
            'category_id' => 'required'
        ]);

    }

    public function updateProduct(){

        $this->validate(
            [
                'name' => 'required',
                'slug' => 'required',
                'description' => 'required',
                'short_description' => 'required',
                'regular_price' => 'required|numeric',
                'sale_price' => 'numeric',
                'sku' => 'required',
                'quantity' => 'required|numeric',
                'stock_status' => 'required',
                'newImage' => 'required_without:image',
                'newImages'=>'required_without:images',
                'category_id' => 'required'
            ]

        );
        $product = Product::find($this->product_id);

        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->short_description = $this->short_description;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->sku;
        $product->quantity = $this->quantity;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->category_id = $this->category_id;
        $product->expiryDate = $this->expiryDate;

        if ($this->newImage){

            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('products',$imageName);
            $product->image = $imageName;

        }

        if ($this->newImages){
            $imagesName = "";
            foreach ($this->newImages as $key=>$image){
                $imgName = Carbon::now()->timestamp. $key. '.'.$image->extension();
                $image->storeAs('products',$imgName);
                $imagesName = $imagesName . ',' . $imgName;
            }
            $product->images = $imagesName;
        }


        $product->save();

        session()->flash('message','Product has been Updated successfully!');



    }


    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-edit-product-component',['categories'=>$categories])->layout('layouts.base');
    }
}

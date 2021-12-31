<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\searchFor;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class AdminProductComponent extends Component
{
    use WithPagination;

    public $search;
    public $name;
    public $inName;
    public $inCategory;
    public $category;



    public function searchForProduct(){
        $this->name = $this->inName;
        $this->category = $this->inCategory;
    }



    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        session()->flash('message','Product has been Deleted successfully');
    }

    public function chartsSetup($id){
        $search = searchFor::find(1);
        if($search){
            $search->keyWord = $id;
            $search->save();
        } else {
            $search = new searchFor();
            $search->keyWord = $id;
            $search->save();
        }

    }

    public function render()
    {

        if ($this->name && $this->category){
            $product = Product::where('category_id',$this->category)->where('name','like','%'.$this->name.'%')->paginate(10);
        } else if($this->name) {
            $product = Product::where('name','like','%'.$this->name.'%')->paginate(10);
        }else if($this->category) {
//            dd($this->category);
            $product = Product::where('category_id',$this->category)->paginate(10);
        } else {
            $product = Product::paginate(10);
        }

        $categories = Category::all();

        return view('livewire.admin.admin-product-component',['products'=>$product,'categories'=>$categories])->layout('layouts.base');
    }
}

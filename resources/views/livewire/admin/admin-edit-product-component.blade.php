<div class="flex-wrapper">
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Edit Product
                        </div>

                        <div class="col-md-6">
                            <a href="{{route('admin.products')}}" class="btn btn-success pull-right"> All Products</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateProduct">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Name</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Product Name" class="form-control input-md" wire:model="name" wire:keyup="generateSlug">
                                @error('name') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Slug</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Product Slug" class="form-control input-md" wire:model="slug">
                                @error('slug') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Description</label>
                            <div class="col-md-4">
                                <textarea placeholder="Product Description" class="form-control input-md" wire:model="description"></textarea>
                                @error('description') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Short Description</label>
                            <div class="col-md-4">
                                <textarea placeholder="Short Description" class="form-control input-md" wire:model="short_description"></textarea>
                                @error('short_description') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Regular Price</label>
                            <div class="col-md-4">
                                <input step=".01" type="number" placeholder="Regular Price" class="form-control input-md" wire:model="regular_price"/>
                                @error('regular_price') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Sale Price</label>
                            <div class="col-md-4">
                                <input step=".01" type="number" placeholder="Sale Price" class="form-control input-md" wire:model="sale_price"/>
                                @error('sale_price') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Stock keeping Unit</label>
                            <div class="col-md-4">
                                <textarea placeholder="Letters and Numbers" class="form-control input-md" wire:model="sku"></textarea>
                                @error('sku') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Expiry Date</label>
                            <div class="col-md-4">
                                <input type="date" placeholder="Expiry Date" class="form-control input-md" wire:model="expiryDate"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Stock</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="stock_status">
                                    <option value="instock" >In Stock</option>
                                    <option value="outofstock" >Out Of Stock</option>
                                </select>
                                @error('stock_status') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Featured</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="featured">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Quantity</label>
                            <div class="col-md-4">
                                <input step="1" type="number" placeholder="Quantity" class="form-control input-md" wire:model="quantity"/>
                                @error('quantity') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Image</label>
                            <div class="col-md-4">
                                <input type="file" placeholder="Product Image" class="form-control input-md" wire:model="newImage"/>
                                @if($newImage)
                                    <img src="{{$newImage->temporaryUrl()}}" width="120">
                                @else
                                    <img src="{{asset('assets/images/products')}}/{{$image}}" width="120">
                                @endif
                                @error('newImage') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Gallery</label>
                            <div class="col-md-4">
                                <input type="file" placeholder="Product Image" class="form-control input-md" wire:model="newImages" multiple/>
                                @if($newImages)

                                    @foreach($newImages as $image)
                                        <img src="{{$image->temporaryUrl()}}" width="120">
                                    @endforeach
                                @else
                                    @php
                                        $SImages = explode(",",$images)
                                    @endphp
                                    @foreach($SImages as $image)
                                        @if($image)
                                            <img src="{{asset('assets/images/products')}}/{{$image}}" width="120">
                                        @endif()
                                    @endforeach
                                @endif
                                @error('newImages') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Category</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

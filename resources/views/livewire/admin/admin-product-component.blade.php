<div class="flex-wrapper">
    <style>
        nav svg{
            height:20px;
        }
        nav .hidden{
            display: block !important;
        }
    </style>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All Products
                            </div>

                            <div class="col-md-6">

                                <table class="pull-right">
                                    <tr>
                                        <td >
                                            <input type="text"  placeholder="Enter Product Name" class="form-control input-md" wire:model="inName"/>
                                        </td>

                                        <td>
                                            <select class="form-control" wire:model="inCategory" >
                                                <option value="">All Categories</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td >
                                            <a href="#" wire:click.prevent="searchForProduct" class="btn btn-info pull-right">Search</a>
                                        </td>

                                        <td style="padding-left: 20px;padding-right: 10px">
                                            <a href="{{route('admin.addProducts')}}" class="btn btn-success pull-right">Add New</a>
                                        </td>

                                    </tr>

                                </table>


                            </div>


                        </div>
                    </div>

                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Sale</th>
                                <th>Category</th>
                                <th>Date added</th>
                                <th>expiry Date</th>
                                <th colspan="3" style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td><img src="{{asset('assets/images/products')}}/{{$product->image}}" width="60"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->stock_status}}</td>
                                    <td>{{$product->regular_price}}</td>
                                    <td>
                                        @if($product->sale_price>0)
                                            {{$product->sale_price}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{$product->category->name}}</td>
                                    <td>
                                        {{$product->created_at}}
                                    </td>
                                    <td>
                                        @if($product->expiryDate)
                                            {{$product->expiryDate}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.editProducts',['product_slug'=>$product->slug])}}" style="padding-right: 20px">
                                            <i class="fa fa-edit fa-2x" ></i>
                                        </a>
                                        <a href="{{route('admin.charts')}}" wire:click="chartsSetup('{{$product->id}}')" style="padding-right: 20px">
                                            <i class="fa fa-bar-chart fa-2x" ></i>
                                        </a>
                                        <a href="#" onclick="confirm('Are you sure, you want to delete this Product ?') || event.stopImmediatePropagation()"  wire:click.prevent="deleteProduct('{{$product->id}}')" style="margin-left: 10px">
                                            <i class="fa fa-times fa-2x text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

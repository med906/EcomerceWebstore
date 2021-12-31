<div class="flex-wrapper">
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Add New Category
                        </div>

                        <div class="col-md-6">
                            <a href="{{route('admin.headers')}}" class="btn btn-success pull-right"> All Headers</a>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form class="form-horizontal" wire:submit.prevent="storeHeader">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Header Name</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Header Name" class="form-control input-md" wire:model="name"/>
                                @error('name') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Header Image</label>
                            <div class="col-md-4">
                                <input type="file" class="input-file" wire:model="image">
                                @if($image)
                                    <img src="{{$image->temporaryUrl()}}" width="120"/>
                                @endif
                                @error('image') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="status">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                                @error('status') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Place</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="place">
                                    <option value="">select</option>
                                    <option value="LeftSlide"> Left Home Page Header</option>
                                    <option value="RightSlide"> Right Home Page Header</option>
                                    <option value="LatestProducts"> Latest Products Home Page Header</option>
                                    <option value="ProductCategory"> Product Category Home Page Header</option>
                                    <option value="ShopHeader"> Shop Page Header</option>
                                </select>
                                @error('place') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Url</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Url" class="form-control input-md" wire:model="url"/>
                                @error('url') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

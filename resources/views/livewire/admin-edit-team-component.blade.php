<div class="flex-wrapper">
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Add Edit Team Member
                        </div>

                        <div class="col-md-6">
                            <a href="{{route('admin.team')}}" class="btn btn-success pull-right"> Team</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateMember">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Image</label>
                            <div class="col-md-4">
                                <input type="file" placeholder="Image" class="form-control input-md" wire:model="newImage"/>
                                @if($newImage)
                                    <img src="{{$newImage->temporaryUrl()}}" width="120">
                                @else
                                    <img src="{{asset('assets/images/members')}}/{{$image}}" width="120">
                                @endif
                                @error('newImage') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Name" class="form-control input-md" wire:model="name" >
                                @error('name') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Title</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Title" class="form-control input-md" wire:model="title">
                                @error('slug') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-4">
                                <textarea placeholder="Description" class="form-control input-md" wire:model="description"></textarea>
                                @error('description') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

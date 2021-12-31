<div class="flex-wrapper">
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Edit Profile
                        </div>

                    </div>

                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form class="form-horizontal" wire:submit.prevent="updateProfile">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Picture</label>
                            <div class="col-md-4">
                                <input type="file" placeholder="Profile Picture" class="form-control input-md" wire:model="newImage"/>
                                @if($newImage)
                                    <img src="{{$newImage->temporaryUrl()}}" width="120">
                                @elseif($image)
                                    <img src="{{ asset('assets/images/Users')}}/{{$image}}" width="120">
                                @else
                                    <img src="{{ asset('assets/images/user.png')}}" width="120">
                                @endif
                                @error('newImage') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">User Name</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Your Name" class="form-control input-md" wire:model="name"/>
                                @error('name') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-4">
                                <input type="email" placeholder="Category slug" class="form-control input-md" wire:model="email"/>
                                @error('email') <p class="text-danger">{{$message}}</p> @enderror
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

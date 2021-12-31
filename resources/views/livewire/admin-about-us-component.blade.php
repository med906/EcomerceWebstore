<div class="flex-wrapper">
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Edit About Us
                        </div>

                    </div>
                </div>
            <div class="panel-body">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                @endif
                <form class="form-horizontal" wire:submit.prevent="updateInfo">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Title</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="Title" class="form-control input-md" wire:model="title"/>
                            @error('name') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Description</label>
                        <div class="col-md-4">
                            <textarea placeholder="Description" class="form-control input-md" wire:model="description"></textarea>
                            @error('slug') <p class="text-danger">{{$message}}</p> @enderror
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

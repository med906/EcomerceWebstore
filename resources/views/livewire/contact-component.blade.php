

<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Add New Message
                        </div>


                    </div>

                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form class="form-horizontal" wire:submit.prevent="sendMessage">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Your Full Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control input-md" name="name" placeholder="Your Full Name" wire:model="name"/>
                                @error('name') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="email"  class="form-control input-md" name="email" placeholder="Your Email" wire:model="email"/>
                                @error('email') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-6">
                                <input type="number"  class="form-control input-md" name="phone" placeholder="Your Phone Number" wire:model="phone"/>
                                @error('phone') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Comment</label>
                            <div class="col-md-6">
                                <textarea rows="10" name="comment" class="form-control input-md" placeholder="Your Comment" wire:model="comment"></textarea>
                                @error('comment') <p class="text-danger">{{$message}}</p>@enderror
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

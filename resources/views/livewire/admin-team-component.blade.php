<div class="flex-wrapper">
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display:block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            All Team Members
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.addTeam')}}" class="btn btn-success pull-right">Add New Team Member</a>
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
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($team as $tea)
                            <tr>
                                <td>{{$tea->id}}</td>
                                <td><img src="{{asset('assets/images/members')}}/{{$tea->image}}" width="60"></td>
                                <td>{{$tea->name}}</td>
                                <td>{{$tea->title}}</td>
                                <td>{{$tea->teamDescription}}</td>
                                <td>
                                    <a href="{{route('admin.editTeam',['team_id'=>$tea->id])}}" >
                                        <i class="fa fa-edit fa-2x" ></i>
                                    </a>
                                    <a href="#" onclick="confirm('Are you sure, you want to remove this member ?') || event.stopImmediatePropagation()"  wire:click.prevent="removeMember('{{$tea->id}}')" style="margin-left: 10px">
                                        <i class="fa fa-times fa-2x text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$team->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

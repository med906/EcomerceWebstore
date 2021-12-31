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
                            All Users
                        </div>

                        <div class="col-md-6">

                            <table class="pull-right">
                                <tr>
                                    <td >
                                        <input type="text"  placeholder="Enter A Value" class="form-control input-md" wire:model="inName"/>
                                    </td>

                                    <td>
                                        <select class="form-control" wire:model="inFilter" >
                                            <option value="email">User Email</option>
                                            <option value="name">User Name</option>
                                            <option value="id">User Id</option>
                                        </select>
                                    </td>

                                    <td >
                                        <a href="#" wire:click.prevent="searchForUser" class="btn btn-info pull-right">Search</a>
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
                            <th>Email</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    @if($user->allowed == 1)
                                        <p style="color: limegreen">Allowed</p>
                                    @elseif($user->allowed == 0)
                                        <p style="color: indianred">blocked</p>
                                    @else
                                        {{$user->allowed}}
                                    @endif
                                </td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" >Status
                                            <span class="caret"></span> </button>
                                        <ul class="dropdown-menu">
                                            <li> <a href="#" onclick="confirm('Are you sure, you want to allow this user ?') || event.stopImmediatePropagation()" wire:click.prevent="updateStatus({{$user->id}},1)">Allowed</a></li>
                                            <li> <a href="#" onclick="confirm('Are you sure, you want to block this user ?') || event.stopImmediatePropagation()" wire:click.prevent="updateStatus({{$user->id}},0)">Blocked</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

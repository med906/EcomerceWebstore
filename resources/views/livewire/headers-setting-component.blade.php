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
                            All Headers
                        </div>

                        <div class="col-md-6">
                            <a href="{{route('admin.addHeader')}}" class="btn btn-success pull-right">Add New</a>
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
                            <th>name</th>
                            <th>image</th>
                            <th>Status</th>
                            <th>place</th>
                            <th>url</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($headers as $header)
                            <tr>
                                <td>{{$header->name}}</td>
                                <td><img src="{{asset('assets/images/headers')}}/{{$header->image}}" width="60"></td>
                                <td>
                                    @if($header->status == 1)
                                        <p style="color: limegreen">Active</p>
                                    @else
                                        <p style="color: indianred">Inactive</p>
                                    @endif
                                </td>
                                <td>{{$header->type}}</td>
                                <td>{{$header->url}}</td>
                                <td>
                                    <a href="{{route('admin.editHeader',['header_id'=>$header->id])}}" >
                                        <i class="fa fa-edit fa-2x" ></i>
                                    </a>
                                    <a href="#" onclick="confirm('Are you sure, you want to delete this Header ?') || event.stopImmediatePropagation()"  wire:click.prevent="deleteHeader('{{$header->id}}')" style="margin-left: 10px">
                                        <i class="fa fa-times fa-2x text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        {{$headers->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

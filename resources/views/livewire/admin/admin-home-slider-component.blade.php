<div class="flex-wrapper">
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All Slides
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.addHomeSlider')}}" class="btn btn-success pull-right"> Add New</a>
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
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>price</th>
                                    <th>Status</th>
                                    <th>Link</th>
                                    <th>Date</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slide)
                                    <tr>
                                        <td>{{$slide->id}}</td>
                                        <td><img src="{{asset('assets/images/sliders')}}/{{$slide->image}}" width="120"> </td>
                                        <td>{{$slide->title}}</td>
                                        <td>{{$slide->subtitle}}</td>
                                        <td>{{$slide->price}}</td>
                                        <td>{{$slide->status == 1 ? 'Active':'Inactive'}}</td>
                                        <td>{{$slide->link}}</td>
                                        <td>{{$slide->created_at}}</td>
                                        <td>
                                            <a href="{{route('admin.editHomeSlider',['slide_id'=>$slide->id])}}">
                                                <i class="fa fa-edit fa-2x text-info"></i></a>
                                        </td>
                                        <td>
                                            <a onclick="confirm('Are you sure, you want to delete this slide ?') || event.stopImmediatePropagation()"  href="#" wire:click.prevent="deleteSlide('{{$slide->id}}')" style="margin-left: 10px">
                                                <i class="fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

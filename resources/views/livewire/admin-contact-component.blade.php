<div class="flex-wrapper">
    <div class="container" style="padding: 30px 0">
        <style>
            nav svg{
                height: 20px;
            }
            nav.hidden {
                display: block; !important;
            }
        </style>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All Contacts
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
                                                <option value="phone">Phone</option>
                                                <option value="id">Message Id</option>
                                            </select>
                                        </td>

                                        <td >
                                            <a href="#" wire:click.prevent="searchForMessage" class="btn btn-info pull-right">Search</a>
                                        </td>


                                    </tr>

                                </table>


                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Comment</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->phone}}</td>
                                        <td>{{$contact->comment}}</td>
                                        <td>{{$contact->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$contacts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                            All Orders
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
                            <th>OrderId</th>
                            <th>Total</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Zipcode</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->firstName}}</td>
                                <td>{{$order->lastName}}</td>
                                <td>{{$order->number}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->zipcode}}</td>
                                <td>
                                    @if($order->status == 'delivered')
                                        <p style="color: limegreen">{{$order->status}}</p>
                                    @elseif($order->status == 'canceled')
                                        <p style="color: indianred">{{$order->status}}</p>
                                    @else
                                        {{$order->status}}
                                    @endif
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <a  class="btn btn-info btn-sm" href="{{route('user.orderDetail',['order_id'=>$order->id])}}" >
                                        Details
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

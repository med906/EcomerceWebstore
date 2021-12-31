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

        @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="alert alert-success" role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
        @endif

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Order Details
                            </div>
                            <div class="col-md-6">
                                @if($order->status == 'ordered')
                                    <a href="#"  onclick="confirm('Are you sure, you want to delete this Order ?') || event.stopImmediatePropagation()" wire:click.prevent="cancelOrder" class="btn btn-warning pull-right"> Cancel Order</a>
                                @endif
                                <a href="{{route('user.orders')}}" style="margin-right: 20px" class="btn btn-success pull-right"> All Orders</a>

                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Order Id</th>
                                <td>{{$order->id}}</td>
                                <th>Order Date</th>
                                <td>{{$order->created_at}}</td>
                                <th>Status</th>
                                <td>
                                    @if($order->status == 'delivered')
                                        <p style="color: limegreen">{{$order->status}}</p>
                                    @elseif($order->status == 'canceled')
                                        <p style="color: indianred">{{$order->status}}</p>
                                    @else
                                        {{$order->status}}
                                    @endif
                                </td>
                                @if($order->status == 'delivered')
                                    <th>delivery date</th>
                                    <th>{{$order->delivered_date}}</th>
                                @elseif ($order->status == 'canceled')
                                    <th>cancellation date</th>
                                    <th>{{$order->canceled_date}}</th>
                                @endif
                                <td>{{$order->id}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Order Items
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="wrap-iten-in-cart">
                            <h3 class="box-title">Products Name</h3>
                            <ul class="products-cart">
                                @foreach($order->orderItems as $item)
                                    <li class="pr-cart-item">
                                        <div class="product-image">
                                            <figure><img src="{{asset('assets/images/products')}}/{{$item->product->image}}" alt="{{$item->product->name}}"/></figure>
                                        </div>
                                        <div class="product-name">
                                            <a class="link-to-product" href="{{route('product.details',['slug'=>$item->product->slug])}}">{{$item->product->name}}</a>
                                        </div>
                                        <div class="price-field produtc-price"><p class="price">Price: ${{$item->price}}</p></div>

                                        <div class="quantity">
                                            <div class="price-field produtc-price"><p class="price"> Quantity: {{$item->quantity}}</p></div>

                                        </div>
                                        <div class="price-field sub-total"><p class="price">Total Price: ${{$item->price * $item->quantity}}</p></div>
                                        @if($order->status == 'delivered' && $item->rstatus == false)
                                            <div class="price-field sub-total"><p class="price"><a href="{{route('user.review',['order_item_id'=>$item->id])}}">Write A Review</a></p></div>
                                        @endif

                                    </li>
                                @endforeach
                            </ul>
                            <div class="summary">
                                <div class="order-summary">
                                    <h4 class="title-box">Order Summary</h4>
                                    <p class="summary-info" style="font-size: 25px" >Total Price<b class="index " style="font-size: 25px">${{$order->total}}</b></p>
                                    <br/>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Billing Details
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>First Name</th>
                                <td>{{$order->firstName}}</td>
                                <th>Last Name</th>
                                <td>{{$order->lastName}}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{$order->number}}</td>
                                <th>Email</th>
                                <td>{{$order->email}}</td>
                            </tr>

                            <tr>
                                <th>First Address</th>
                                <td>{{$order->line1}}</td>
                                <th>Second Address</th>
                                <td>{{$order->line2}}</td>
                            </tr>

                            <tr>
                                <th>Country</th>
                                <td>{{$order->country}}</td>
                                <th>City</th>
                                <td>{{$order->city}}</td>
                            </tr>

                            <tr>
                                <th>Province</th>
                                <td>{{$order->province}}</td>
                                <th>Zipcode</th>
                                <td>{{$order->zipcode}}</td>
                            </tr>
                        </table>

                    </div>

                </div>
            </div>
        </div>

        {{--        <div class="row">--}}
        {{--            <div class="col-md-12">--}}
        {{--                <div class="panel panel-default">--}}
        {{--                    <div class="panel-heading">--}}
        {{--                        <div class="row">--}}
        {{--                            <div class="col-md-6">--}}
        {{--                                Shipping Details--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                    </div>--}}
        {{--                    <div class="panel-body">--}}

        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Transaction Details
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">

                        <table class="table">
                            <tr>
                                <th>Transaction Method</th>
                                <td>{{$order->transaction->mode}}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>{{$order->transaction->status}}</td>
                            </tr>

                            <tr>
                                <th>Transaction Date</th>
                                <td>{{$order->transaction->created_at}}</td>
                            </tr>

                        </table>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


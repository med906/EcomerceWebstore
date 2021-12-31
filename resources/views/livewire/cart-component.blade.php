<div class="flex-wrapper">
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">home</a></li>
                    <li class="item-link"><span>Cart</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->count() >0)
                    <div class="wrap-iten-in-cart">
                        @if(\Illuminate\Support\Facades\Session::has('success_message'))
                            <div class="alert alert-success">
                                <strong>Success</strong> {{\Illuminate\Support\Facades\Session::get('success_message')}}
                            </div>
                        @endif
                        @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->count()>0)
                            <h3 class="box-title">Products Name</h3>
                            <ul class="products-cart">
                                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content() as $item)
                                    <li class="pr-cart-item">
                                        <div class="product-image">
                                            <figure><img src="{{asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"/></figure>
                                        </div>
                                        <div class="product-name">
                                            <a class="link-to-product" href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
                                        </div>
                                        @if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > \Carbon\Carbon::now())
                                            <div class="price-field produtc-price"><p class="price">${{$item->model->sale_price}}</p></div>
                                        @else
                                            <div class="price-field produtc-price"><p class="price">${{$item->model->regular_price}}</p></div>
                                        @endif
                                        <div class="quantity">
                                            <div class="quantity-input">
                                                <input type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" readonly>
                                                <a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity('{{$item->rowId}}')"></a>
                                                <a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"></a>
                                            </div>
                                            <p class="text-center"><a href="#" wire:click.prevent="switchToSaveForLater('{{$item->rowId}}')">Save For Later</a></p>
                                        </div>
                                        <div class="price-field sub-total"><p class="price">${{$item->subtotal}}</p></div>

                                        <div class="delete">
                                            <a href="#" class="btn btn-delete"  wire:click.prevent="destroy('{{$item->rowId}}')" title="">
                                                <span>Delete from your cart</span>
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>




                    <div class="summary">
                        <div class="order-summary">
                            <h4 class="title-box">Order Summary</h4>
                            {{--                    <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{Cart::instance('cart')->subtotal()}}</b></p>--}}
                            {{--                    @if(\Illuminate\Support\Facades\Session::has('coupon'))--}}
                            {{--                        <p class="summary-info"><span class="title">Discount ({{\Illuminate\Support\Facades\Session::get('coupon')['code']}})</span><b class="index">${{$discount}}</b></p>--}}
                            {{--                        <p class="summary-info"><span class="title">Subtotal with Discount</span><b class="index">${{$subtotalAfterDiscount}}</b></p>--}}
                            {{--                        <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{$totalAfterDiscount}}</b></p>--}}
                            {{--                    @else--}}
                            {{--                        <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>--}}
                            {{--                        <p class="summary-info">Total Price<b class="index ">${{Cart::instance('cart')->subtotal()}}</b></p>--}}
                            {{--                    @endif--}}
                            <p class="summary-info" style="font-size: 25px" >Total Price<b class="index " style="font-size: 25px">${{Cart::instance('cart')->subtotal()}}</b></p>
                            <br/>
                            <div class="checkout-info">
                                {{--                        wire:click.prevent="checkout"--}}
                                <a class="btn btn-checkout" wire:click.prevent="checkout" href="{{route('checkout')}}">Check out</a>
                                <a class="link-to-shop" href="/shop">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <br/>
                        @if(\Illuminate\Support\Facades\Session::has('coupon'))
                            <div class="checkout-info">
                                <label class="checkbox-field">
                                    <input class="frm-input " wire:model="hasACouponCode" name="have-code" id="have-code" value="" type="checkbox"><span>I have coupon code</span>
                                </label>
                                @if($hasACouponCode == 1)
                                    <div class="summary-item">
                                        <h4 class="title-box">Coupon Code</h4>
                                        @if(\Illuminate\Support\Facades\Session::has('coupon_message'))
                                            <div class="alert alert-danger" role="alert">{{\Illuminate\Support\Facades\Session::get('coupon_message')}}</div>
                                        @endif
                                        <p class="row-in-form">
                                            <label for="coupon-code">Enter your coupon code: </label>
                                            <input type="text" wire:model="couponCode" name="coupon-code"/>
                                        </p>
                                        <button type="submit" class="btn btn-small">Apply</button>
                                    </div>
                                @endif
                                <a class="btn btn-checkout" wire:click.prevent="checkout" href="checkout.html">Check out</a>
                                <a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                            </div>
                        @endif
                        <div class="update-clear">
                            <a class="btn btn-clear" href="#" wire:click.prevent="destroyAll()">Clear Shopping Cart</a>
                        </div>
                    </div>
                @else
                    <div class="text-center" style="padding:30px 0;">
                        <h1> Your Cart is empty!</h1>
                        <p> Add items to it now </p>
                        <a href="/shop" class="btn btn-success">Shop Now</a>
                    </div>
                @endif
                <div class="wrap-iten-in-cart">
                    <h3 class="title-box" style="border-bottom: 1px solid; padding-bottom:15px ">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->count()}} item(s) Save For Later</h3>
                    @if(\Illuminate\Support\Facades\Session::has('s_success_message'))
                        <div class="alert alert-success">
                            <strong>Success</strong> {{\Illuminate\Support\Facades\Session::get('s_success_message')}}
                        </div>
                    @endif
                    @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->count()>0)
                        <h3 class="box-title">Products Name</h3>
                        <ul class="products-cart">
                            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->content() as $item)
                                <li class="pr-cart-item">
                                    <div class="product-image">
                                        <figure><img src="{{asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"/></figure>
                                    </div>
                                    <div class="product-name">
                                        <a class="link-to-product" href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
                                    </div>
                                    @if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > \Carbon\Carbon::now())
                                        <div class="price-field produtc-price"><p class="price">${{$item->model->sale_price}}</p></div>
                                    @else
                                        <div class="price-field produtc-price"><p class="price">${{$item->model->regular_price}}</p></div>
                                    @endif
                                    <div class="quantity">
                                        <p class="text-center"><a href="#" wire:click.prevent="moveToCart('{{$item->rowId}}')">Move To Cart</a></p>
                                    </div>
                                    <div class="delete">
                                        <a href="#" class="btn btn-delete"  wire:click.prevent="deleteFromSaveForLater('{{$item->rowId}}')" title="">
                                            <span>Delete from Save For Later</span>
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No item(s) Saved for Later</p>
                    @endif
                </div>



            </div><!--end main content area-->
        </div><!--end container-->


    </main>

</div>

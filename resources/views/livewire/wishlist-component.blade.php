<div class="flex-wrapper">
    <main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>WishList</span></li>
            </ul>
        </div>

        <style>
            .product-wish{
                position: absolute;
                top: 10%;
                left: 0;
                z-index: 99;
                right: 30px;
                text-align: right;
                padding-top: 0;
            }
            .product-wish .fa {
                color: #cbd5e0;
                font-size: 32px;
            }
            .product-wish .fa:hover{
                color: #ff2b60;
            }
            .fill-heart {
                color: #ff2b60 !important;
            }
        </style>

        <div class="row">

            <ul class="product-list grid-products equal-container">
                @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count()>0)
                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $wItem)
                        <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                        <div class="product product-style-3 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{route('product.details',['slug'=>$wItem->model->slug])}}" title="{{$wItem->model->name}}">
                                    <figure><img src="{{asset('assets/images/products')}}/{{$wItem->model->image}}" alt="{{$wItem->model->name}}"></figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="{{route('product.details',['slug'=>$wItem->model->slug])}}" class="product-name"><span>{{$wItem->model->name}}</span></a>
                                <div class="wrap-price"><span class="product-price">{{$wItem->model->regular_price}}</span></div>
                                <a href="#" class="btn add-to-cart" wire:click.prevent="moveProductFromWishlistToCart('{{$wItem->rowId}}')">Move To Cart</a>
                                <div class="product-wish">
                                    <a href="#" wire:click.prevent="removeFromWishList({{$wItem->model->id}})" class="fa fa-heart fill-heart"></a>
                                </div>
                            </div>
                        </div>
                    </li>@endforeach
                @else
                    <h4> No Items in Wishlist</h4>
                @endif
            </ul>

        </div>

    </div>
</main>
</div>

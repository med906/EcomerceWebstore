

<div class="wrap-icon-section minicart">
    <a href="{{route('product.cart')}}" class="link-direction">
        @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->count() > 0)
            <i class="fa fa-shopping-basket fill-Basket" aria-hidden="true"></i>

        @else
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        @endif
        <div class="left-info">
            @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->count() > 0)
                <span class="index">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->count()}} item(s)</span>
            @endif()
            <span class="title">CART</span>
        </div>
    </a>
</div>

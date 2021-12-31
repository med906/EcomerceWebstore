<div>
    <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="wrap-show-advance-info-box style-1 box-in-site">
            <h3 class="title-box">Related Products</h3>
            <div class="wrap-products">
                <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
                    @foreach($related_products as $r_product)

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{route('product.details',['slug'=>$r_product->slug])}}" title="{{$r_product->name}}">
                                    <figure><img src="{{ asset('assets/images/products')}}/{{$r_product->image}}"  style="width: 300px;height: 200px" alt="{{$r_product->name}}"/></figure>
                                </a>

                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{$r_product->name}}</span></a>
                                    <div class="wrap-price"><span class="product-price">{{$r_product->regular_price}}</span></div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div><!--End wrap-products-->
        </div>
    </div>

</div>

<div class="flex-wrapper">
    <main id="main">
        @if($setup)
            <div class="container">

                <!--MAIN SLIDE-->
                <div class="wrap-main-slide">
                    <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">

                        @foreach($sliders as $slide)
                            <div class="item-slide">
                                <img src="{{asset('assets/images/sliders')}}/{{$slide->image}}" width="890" height="500" alt="{{$slide->title}}" class="img-slide">
                                <div class="slide-info slide-1">
                                    <h2 class="f-title"><b>{{$slide->title}}</b></h2>
                                    <span class="f-subtitle">{{$slide->subtitle}}</span>
                                    <p class="sale-info">Stating at: <b class="price">${{$slide->price}}</b></p>
                                    <a href="{{$slide->link}}" class="btn-link">Shop Now</a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!--BANNER-->
                <div class="wrap-banner style-twin-default">
                    <div class="banner-item">
                        <a href="#" class="link-banner banner-effect-1">
                            @if($leftSlide)
                                <figure><img src="{{asset('assets/images/headers')}}/{{$leftSlide}}" alt="Set up the leftSlide " style="width:580px;height: 190px " width="580" height="190"></figure>
                            @endif
                        </a>
                    </div>
                    <div class="banner-item">
                        <a href="#" class="link-banner banner-effect-1">
{{--                            <figure><img src="{{asset('assets/images/home-1-banner-2.jpg')}}" alt="" width="580" height="190"></figure>--}}
                            @if($rightSlide)
                                <figure><img src="{{asset('assets/images/headers')}}/{{$rightSlide}}" alt="Set up the leftSlide " style="width:580px;height: 190px " width="580" height="190"></figure>
                            @endif
                        </a>
                    </div>
                </div>

                <!--On Sale-->
                @if($sProducts->count() > 0 && $sale->status == 1 && $sale->sale_date > \Carbon\Carbon::now())
                    <div class="wrap-show-advance-info-box style-1 has-countdown">
                        <h3 class="title-box">On Sale</h3>
                        <div class="wrap-countdown mercado-countdown" data-expire="{{Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s')}}"></div>
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                            @foreach($sProducts as $sProd)

                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{route('product.details',['slug'=>$sProd->slug])}}" title="{{$sProd->name}}">
                                            <figure><img src="{{asset('assets/images/products')}}/{{$sProd->image}}" width="800" height="800" alt="{{$sProd->name}}"></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item sale-label">sale</span>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{route('product.details',['slug'=>$sProd->slug])}}" class="product-name"><span>{{$sProd->name}}</span></a>
                                        <div class="wrap-price"><span class="product-price">${{$sProd->sale_price}}</span></div>
                                    </div>
                                </div>


                            @endforeach
                        </div>
                    </div>
            @endif

            <!--Latest Products-->
                <div class="wrap-show-advance-info-box style-1">
                    <h3 class="title-box">Latest Products</h3>
                    <div class="wrap-top-banner">
                        <a href="#" class="link-banner banner-effect-2">
{{--                            <figure><img src="{{asset('assets/images/digital-electronic-banner.jpg')}}" width="1170" height="240" alt=""></figure>--}}
                            @if($latestProducts)
                                <figure><img src="{{asset('assets/images/headers')}}/{{$latestProducts}}" alt="Set up the leftSlide " style="width:1170px;height: 240px " width="1170" height="240"></figure>
                            @endif
                        </a>
                    </div>
                    <div class="wrap-products">
                        <div class="wrap-product-tab tab-style-1">
                            <div class="tab-contents">
                                <div class="tab-content-item active" id="digital_1a">
                                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                        @foreach($lProducts as $lProduct)
                                            <div class="product product-style-2 equal-elem ">
                                                <div class="product-thumnail">
                                                    <a href="{{route('product.details',['slug'=>$lProduct->slug])}}" title="{{$lProduct->name}}">
                                                        <figure><img src="{{asset('assets/images/products')}}/{{$lProduct->image}}" width="800" height="800" alt="{{$lProduct->name}}"></figure>
                                                    </a>
                                                    <div class="wrap-btn">
                                                        <a href="{{route('product.details',['slug'=>$lProduct->slug])}}" class="function-link">quick view</a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <a href="#" class="product-name"><span>{{$lProduct->name}}</span></a>
                                                    <div class="wrap-price"><span class="product-price">${{$lProduct->regular_price}}</span></div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Product Categories-->
                <div class="wrap-show-advance-info-box style-1">
                    <h3 class="title-box">Product Categories</h3>
                    <div class="wrap-top-banner">
                        <a href="#" class="link-banner banner-effect-2">
{{--                            <figure><img src="{{asset('assets/images/fashion-accesories-banner.jpg')}}" width="1170" height="240" alt=""></figure>--}}
                            @if($productsCategories)
                                <figure><img src="{{asset('assets/images/headers')}}/{{$productsCategories}}" alt="Set up the leftSlide " style="width:1170px;height: 240px " width="1170" height="240"></figure>
                            @endif
                        </a>
                    </div>
                    <div class="wrap-products">
                        <div class="wrap-product-tab tab-style-1">
                            <div class="tab-control">

                                @foreach($categories as $key=>$category)
                                    <a href="#category_{{$category->id}}" class="tab-control-item {{$key==0 ? 'active':''}}" >{{$category->name}}</a>
                                @endforeach

                            </div>

                            <div class="tab-contents">

                                @foreach($categories as $key=>$category)

                                    <div class="tab-content-item {{$key==0 ? 'active':''}}" id="category_{{$category->id}}" >
                                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                            @php
                                                $cd_products = DB::table('products')->where('category_id',$category->id)->get()->take($category->number_of_products);
                                            @endphp
                                            @foreach($cd_products as $c_prod)
                                                <div class="product product-style-2 equal-elem ">
                                                    <div class="product-thumnail">
                                                        <a href="{{route('product.details',['slug'=>$c_prod->slug])}}" title="{{$c_prod->name}}">
                                                            <figure><img src="{{asset('assets/images/products')}}/{{$c_prod->image}}" width="800" height="800" alt="{{$c_prod->name}}"></figure>
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="{{route('product.details',['slug'=>$c_prod->slug])}}" class="product-name"><span>{{$c_prod->name}}</span></a>
                                                        <div class="wrap-price"><span class="product-price">${{$c_prod->regular_price}}</span></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <br/>
            <br/>
            <br/>
            <h2 style="text-align: center">The Website needs setup</h2>
            <br/>
            <br/>
            <br/>
        @endif

    </main>

</div>

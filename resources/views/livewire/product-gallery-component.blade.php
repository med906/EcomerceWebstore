<div>
    <div class="detail-media">
        <div class="product-gallery">

            <ul class="slides">

                @foreach($images as $image)
                    @if($image)
                        <li data-thumb="{{ asset('assets/images/products')}}/{{$image}}">
                            <img src="{{ asset('assets/images/products')}}/{{$image}}" alt="{{$product->name}}" />
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
</div>

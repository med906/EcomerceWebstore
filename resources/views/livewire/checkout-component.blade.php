<div class="flex-wrapper">
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>login</span></li>
                </ul>
            </div>
            <form wire:submit.prevent="placeOrder">
                <div class=" main-content-area">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wrap-address-billing">
                                <h3 class="box-title">Billing Address</h3>

                                <p class="row-in-form">
                                    <label for="fname">first name<span>*</span></label>
                                    <input type="text" name="fname" value="" wire:model="firstName" placeholder="Your name">
                                    @error('firstName') <span class="text-danger">{{$message}}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="lname">last name<span>*</span></label>
                                    <input type="text" name="lname" value="" wire:model="lastName" placeholder="Your last name">
                                    @error('lastName') <span class="text-danger">{{$message}}</span> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="email">Email Addreess:</label>
                                    <input type="email" name="email" value="" wire:model="emailAddress" placeholder="Type your email">
                                    @error('emailAddress') <span class="text-danger">{{$message}}</span> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Phone number<span>*</span></label>
                                    <input type="number" name="phone" value="" wire:model="phoneNumber" placeholder="Your Phone Number">
                                    @error('phoneNumber') <span class="text-danger">{{$message}}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">First Address:</label>
                                    <input type="text" name="add" value="" wire:model="line1" placeholder="Street at apartment number">
                                    @error('line1') <span class="text-danger">{{$message}}</span> @enderror
                                </p>

                                <p class="row-in-form">
                                    <label for="add">Second Address:</label>
                                    <input type="text" name="add" value="" wire:model="line2" placeholder="Street at apartment number">
                                </p>

                                <p class="row-in-form">
                                    <label for="country">Country<span>*</span></label>
                                    <input type="text" name="country" value="" wire:model="country" placeholder="United States">
                                    @error('country') <span class="text-danger">{{$message}}</span> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Postcode / ZIP:</label>
                                    <input type="number" name="zip-code" value="" wire:model="zipCode" placeholder="Your postal code">
                                    @error('zipCode') <span class="text-danger">{{$message}}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="city">Town / City<span>*</span></label>
                                    <input type="text" name="city" value="" wire:model="city" placeholder="City name">
                                    @error('city') <span class="text-danger">{{$message}}</span> @enderror

                                </p>

                                <p class="row-in-form">
                                    <label for="city">Province<span>*</span></label>
                                    <input type="text" name="city" value="" wire:model="province" placeholder="City name">
                                    @error('province') <span class="text-danger">{{$message}}</span> @enderror

                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="summary">
                        <div class="order-summary">
                            <h4 class="title-box">Order Summary</h4>
                            <div class="choose-payment-methods">
                                <label class="payment-method">
                                    <input name="payment-method" id="payment-method-bank" value="cod" type="radio" wire:model="paymentMode">

                                    <span>Cash On Delivery</span>
                                    <span class="payment-desc">Order Now Pay On delivery </span>
                                </label>
                                @error('paymentMode') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <br/>
                            @if(\Illuminate\Support\Facades\Session::has('checkout'))
                                <p class="summary-info" style="font-size: 25px" >Grand Total<b class="index " style="font-size: 25px">${{\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->subtotal()}}</b></p>
                                <p>shipping Not included*</p>
                            @endif
                            <br/>
                            <div class="checkout-info">
                                <button type="submit" class="btn btn-checkout"  href="#">Place Order</button>
                            </div>
                        </div>

                    </div>

                </div>
            </form>

    </main>
</div>


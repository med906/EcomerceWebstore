{{--<x-guest-layout>--}}
{{--    <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <x-jet-validation-errors class="mb-4" />--}}

{{--        <form method="POST" action="{{ route('password.update') }}">--}}
{{--            @csrf--}}

{{--            <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--            <div class="block">--}}
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
{{--                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <x-jet-button>--}}
{{--                    {{ __('Reset Password') }}--}}
{{--                </x-jet-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}




<x-guest-layout>
    <div class="flex-wrapper">
        <main id="main" class="main-site left-sidebar">

            <div class="container">

                <div class="wrap-breadcrumb">
                    <ul>
                        <li class="item-link"><a href="/" class="link">home</a></li>
                        <li class="item-link"><span>login</span></li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                        <div class=" main-content-area">
                            <div class="wrap-login-item ">
                                <div class="login-form form-item form-stl">
                                    <x-jet-validation-errors class="mb-4" />
                                    <form name="frm-login" method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        <fieldset class="wrap-title">
                                            <h3 class="form-title">Reset Your password</h3>
                                        </fieldset>
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <fieldset class="wrap-input">
                                            <label for="frm-login-uname">Email Address:</label>
                                            <x-jet-input id="email"  type="email" name="email" :value="old('email', $request->email)" required autofocus />
                                        </fieldset>
                                        <fieldset class="wrap-input">
                                            <label for="frm-login-pass">Password:</label>
                                            <x-jet-input id="password"  type="password" placeholder="************" name="password" required autocomplete="new-password" />

                                        </fieldset>
                                        <fieldset class="wrap-input">
                                            <label for="frm-login-pass">Confirm Password:</label>
                                            <x-jet-input id="password_confirmation" placeholder="************" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        </fieldset>


                                        <input type="submit" class="btn btn-submit" value="Reset Password" name="submit">
                                    </form>
                                </div>
                            </div>
                        </div><!--end main products area-->
                    </div>
                </div><!--end row-->

            </div><!--end container-->

        </main>

    </div>
</x-guest-layout>

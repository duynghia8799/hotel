@extends('auth.layouts.master')

@section('content')
    <div class="m-grid m-grid--hor m-grid--root m-page" style="background-image: url({{ asset(config('common.login.background')) }});">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3"
             id="m_login">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="javascript:;">
                            <img src="{{ asset(config('common.login.logo')) }}">
                        </a>
                    </div>
                    <div class="m-login__signin">
                        @if (session('login-error'))
                            <b class="text-danger">Tên đăng nhập hoặc mật khẩu không đúng</b>
                        @endif
                        <form class="m-login__form m-form" action="{{ route('submitLogin') }}" method="post">
                            @csrf
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text"
                                       placeholder="{{ __('messages.Enter_Email') }}" name="email"
                                       value="{{ old('email') }}" autocomplete="off">
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password"
                                       placeholder="{{ __('messages.Enter_password') }}" name="password">
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--light">
                                        <input type="checkbox" name="remember"> {{ __('messages.Remember_me') }}
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col m--align-right m-login__form-right">
                                    <a href="" id="m_login_forget_password"
                                       class="m-link">{{ __('messages.Forget_password') }}</a>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_signin_submit"
                                        class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">{{ __('messages.Sign_in') }}</button>
                            </div>
                            <div class="login-box">
                                {{--<a href="{{ route('client.socialRedirect', 'facebook') }}" class="social-button loginBtn loginBtn--facebook" id="facebook-connect"> <span>{{ __('messages.Login_facebook') }}</span></a>--}}
                                {{--<a href="{{ route('client.socialRedirect', 'google') }}" class="social-button loginBtn loginBtn--google" id="google-connect"> <span>{{ __('messages.Login_google') }}</span></a>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

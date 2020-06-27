@extends('layouts.login')
@section('title', __('common.login'))
@section('content')
    <div id="user-login" style="display: {{ $is_user_state?'block':'none' }};">
        <form class="form-signin" method="POST" action="{{ wzRoute('login') }}">
            {{--<img class="mb-4" src="/assets/wizard.svg" alt="" height="100">--}}
            <h1 class="h3 mb-3 font-weight-normal">@lang('common.login')</h1>
            {{ csrf_field() }}
            <div class="text-left form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="bmd-label-floating">@lang('common.email')</label>
                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <div class="invalid-feedback" style="display: block;">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="text-left form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="bmd-label-floating">@lang('common.password')</label>
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <div class="invalid-feedback" style="display: block;">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <div class="form-group ">
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 下次自动登录
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-lg btn-primary btn-block btn-raised">
                @lang('common.login')
            </button>

            <button type="button" class="btn btn-lg btn-info btn-block btn-raised switch-login-btn">
                企业微信登录
            </button>

            @if (!ldap_enabled() && !wework_enabled())
                <a class="btn btn-link" href="{{ wzRoute('register') }}">
                    @lang('common.register')
                </a>

                <a class="btn btn-link" href="{{ wzRoute('password.request') }}">
                    @lang('common.password_back')?
                </a>
            @endif


        </form>
    </div>
    <div id="wework-login" style="display: {{ !$is_user_state?'block':'none' }}">
        <div id="wx_reg">

        </div>
        <div style="margin: 30px 40px;">
            <button type="button" class="btn btn-lg btn-primary btn-block btn-raised switch-login-btn">
                使用密码登录
            </button>
        </div>
    </div>
    <div>
        <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }} {{ config('wizard.copyright', 'Notta') }}</p>
    </div>

@endsection

@push('script')
    @if(wework_enabled())
    <script src="https://rescdn.qqmail.com/node/ww/wwopenmng/js/sso/wwLogin-1.0.0.js"></script>
    <script>
      window.WwLogin({
        "id" : "wx_reg",
        "appid" : "{{ config('wechat.work.default.corp_id') }}",
        "agentid" : '{{ config('wechat.work.default.agent_id') }}',
        "redirect_uri" : "{{ route('user:wework.login') }}",
        "state" : "web_login",
        "href" : "",
      });
      $('.switch-login-btn').click(()=>{
        $('#wework-login').toggle();
        $('#user-login').toggle();
      });
    </script>
    @endif
@endpush

@extends('layouts.default')

@section('content')

            <form id="reset-form" class="reset-form" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <h3>Reset Password</h3>

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="text"  class="form-control placeholder-no-fix"  autocomplete="off" placeholder="Email" name="email" value="{{ $email or old('email') }}"/>

                    @if ($errors->has('email'))
                        <span class="help-block help-block-error server-error">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input class="form-control form-control-solid placeholder-no-fix" autocomplete="off"  type="password" name="password" id="password" placeholder="Password"/>

                    @if ($errors->has('password'))
                        <span class="help-block help-block-error server-error">
                            {{ $errors->first('password') }}
                        </span>
                    @endif

                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input class="form-control form-control-solid placeholder-no-fix" autocomplete="off"  type="password" name="password_confirmation" id="password-confirm" placeholder="Confirm Password"/>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block help-block-error server-error">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-refresh"></i> Reset Password
                        </button>
                    </div>
                </div>
            </form>

@endsection

@section('page_level_plugins')
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
@endsection

@section('page_level_scripts')

@endsection

@section('footer')
    <script language="JavaScript" type="text/javascript">
        var url_forgot_password='{{url('password/reset')}}';
        var url_login='{{url('login')}}';
        jQuery(document).ready(function () {
            Login.init();
        });
    </script>
    <script src="{{ URL::asset('pages/scripts/login.js')}}" type="text/javascript"></script>
@endsection

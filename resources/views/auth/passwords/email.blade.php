@extends('layouts.default')

<!-- Main Content -->
@section('content')

            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form id="forget-form" class="forget-form" method="post" action="{{ url('/password/email') }}">
                 {{ csrf_field() }}
                <h3>Forget Password ?</h3>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <p>
                     Enter your e-mail address below to reset your password.
                </p>

                <div class="alert alert-danger msg-login display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>
                    Please Enter email. </span>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}"/>
                     @if ($errors->has('email'))
                        <span class="help-block help-block-error server-error">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                    <button type="submit" class="btn btn-success uppercase pull-right">Send Password Reset Link</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
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


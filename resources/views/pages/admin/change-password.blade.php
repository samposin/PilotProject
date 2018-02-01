    @extends('layouts.app')

    @section('title', 'My Account - Change Password')

    @section('page_level_styles')

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('pages/css/profile.css')}}"/>

    @stop

    @section('page_level_custom_styles')

        <link href="{{ URL::asset('css/custom.css')}}" rel="stylesheet" type="text/css"/>
        <style>

        </style>

    @stop

    @section('content')
        <!-- BEGIN PAGE CONTENT-->

                 <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal two-column-layout-form" name="frm_my_account_change_password" id="frm_my_account_change_password" action="" method="post" novalidate="novalidate">
                                <input type="hidden" name="hdn_user_id" id="hdn_user_id" value="{{$user->id}}">
                                {!! csrf_field() !!}
                                <div class="portlet light">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-equalizer font-blue-madison"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">My Account - Change Password</span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn blue-madison btn-circle btn-sm" href="{{url('admin/my-account')}}"> <i class="fa fa-arrow-left"></i> Back</a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        @include('flash::message')
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="col-xs-12 col-sm-9 col-lg-7 form-group">
                                            <label class="col-xs-4 col-sm-5 col-lg-3 col-xs-offset-0 col-sm-offset-0 control-label" for="password">Current Password<span class="required">*</span></label>
                                            <div class="col-xs-8 col-sm-7 col-lg-5">
                                                <div class="controls">
                                                    <input type="password" id="current-password" name="current_password" class="form-control"  placeholder="Enter password" autocomplete="off" >
                                                </div>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-9 col-lg-7 form-group">
                                            <label class="col-xs-4 col-sm-5 col-lg-3 col-xs-offset-0 col-sm-offset-0 control-label" for="password">Password<span class="required">*</span></label>
                                            <div class="col-xs-8 col-sm-7 col-lg-5">
                                                <div class="controls">
                                                    <input type="password" id="password" name="password" class="form-control"  placeholder="Enter password" autocomplete="off" >
                                                </div>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-9 col-lg-7 form-group">
                                            <label class="col-xs-4 col-sm-5 col-lg-3 col-xs-offset-0 col-sm-offset-0 control-label" for="password-confirm">Confirm Password<span class="required">*</span></label>
                                            <div class="col-xs-8 col-sm-7 col-lg-5">
                                                <div class="controls">
                                                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Enter confirm password" autocomplete="off"  >
                                                </div>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-9 col-lg-7 form-group">
                                            <label class="col-xs-4 col-sm-5 col-lg-3 col-xs-offset-0 col-sm-offset-0 control-label" >&nbsp;</label>
                                            <div class="col-xs-8 col-sm-7 col-lg-5">
                                                <div class="pull-right">
                                                <button type="submit" class="btn green"><i class="fa fa-check"></i> Update</button>
                                                <button type="button" class="btn default" id="btnCancel" onclick="location.href='{{url('admin/my-account')}}'"> Cancel</button>
                                            </div>
                                            </div>
                                        </div>
                                         <span class="clearfix"></span>
                                    </div>
                               </div>

                            </form>
                        </div>
                    </div>
                </div>

        <!-- END PAGE CONTENT-->

    @stop

    @section('page_level_plugins')

        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-form/jquery.form.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootbox/bootbox.min.js')}}"></script>

    @stop

    @section('page_level_scripts')

    @stop

    @section('footer')

        <script language="javascript">
            var csrf_token ='{{ csrf_token() }}';
            var url_users_datatable_ajax='{{ route('users-datatable-ajax') }}';
            var url_users='{{ route('users-home') }}';
            var url_check_user_email_availability='{{url('admin/users/check-email-availability')}}';
        </script>
        <script src="{{ URL::asset('pages/scripts/admin/change-password.js')}}"></script>

    @stop

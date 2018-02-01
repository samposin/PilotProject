    @extends('layouts.app')

    @section('title', 'My Account')

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
                            <form class="form-horizontal two-column-layout-form" name="frm_my_account_edit" id="frm_my_account_edit" action="" method="post" novalidate="novalidate">
                                <input type="hidden" name="hdn_user_id" id="hdn_user_id" value="{{$user->id}}">
                                {!! csrf_field() !!}
                                <div class="portlet light">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-equalizer font-blue-madison"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">My Account</span>
                                        </div>
                                        <div class="actions">
                                            <a href="javascript:void(0);" id="anc_edit_my_account" class="btn btn-default btn-circle display_value_section">
                                                <i class="fa fa-pencil"></i>
                                                <span class="hidden-480">Edit</span>
                                            </a>
                                            <a href="{{url('admin/my-account/change-password')}}" id="anc_change_password" class="btn btn-success btn-circle">
                                                <i class="fa fa-key"></i>
                                                <span class="hidden-480">Change Password</span>
                                            </a>
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
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-5 control-label" for="username">Username<span class="required">*</span></label>
                                            <div class="col-xs-7">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="username" name="username" class="form-control"  placeholder="Enter username" value="{{$user->username}}" readonly>
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$user->username}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-5 control-label" for="email">Email<span class="required">*</span></label>
                                            <div class="col-xs-7">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" value="{{$user->email}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$user->email}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-5 control-label" for="firstname">Firstname<span class="required">*</span></label>
                                            <div class="col-xs-7">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter firstname"  value="{{$user->firstname}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$user->firstname}}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-5 control-label" for="lastname">Lastname<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-7">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter lastname"  value="{{$user->lastname}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$user->lastname}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                    </div>
                               </div>
                                <div class="form-actions display_control_section">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-right">
                                                <button type="submit" class="btn green"><i class="fa fa-check"></i> Update</button>
                                                <button type="button" class="btn default" id="btnCancel"> Cancel</button>
                                            </div>
                                        </div>
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
        <script src="{{ URL::asset('js/common.js')}}"></script>
        <script src="{{ URL::asset('pages/scripts/admin/my-account.js')}}"></script>

    @stop

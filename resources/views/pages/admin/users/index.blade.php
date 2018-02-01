    @extends('layouts.app')

    @section('title', 'Users')

    @section('page_level_styles')

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"/>

    @stop

    @section('page_level_custom_styles')
        <link href="{{ URL::asset('css/custom.css')}}" rel="stylesheet" type="text/css"/>
        <style>


        </style>
    @stop

    @section('content')

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Begin: life time stats -->
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user font-blue-sharp"></i>
                                            <span class="caption-subject font-blue-sharp bold uppercase">Users</span>
                                            <span class="caption-helper">view & filter...</span>
                                        </div>
                                        <div class="actions">
                                            <a href="javascript:void(0);" id="anc_create_user" class="btn btn-default btn-circle">
                                                <i class="fa fa-plus"></i>
                                                <span class="hidden-480">
                                                    New User
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <form name="frm_datatable" id="frm_datatable" method="post">
                                            <div class="app_msg">
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
                                            </div>
                                            @include('flash::message')
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="action" id="action" value="">
                                            <div class="table-container">
                                                <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                                                    <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="15%">
                                                            Username
                                                        </th>
                                                        <th >
                                                            Name
                                                        </th>
                                                        <th >
                                                            Email
                                                        </th>
                                                        <th class="no-sort" width="12%">
                                                            Login status
                                                        </th>

                                                        <th class="no-sort" width="10%">
                                                            Actions
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($users))
                                                        @foreach($users as $user)
                                                        <tr>
                                                            <td>{{$user->username}}</td>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$user->email}}</td>
                                                            <td>{!!$user->last_logged_in_at_display_html!!}</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a href="javascript:void(0);" onclick="goToEditPage(event,'{{$user->id}}');" data-user-id="{{$user->id}}" class="btn btn-sm btn-primary btn-list-edit"><i class="fa fa-search"></i></a>
                                                                    <a href="javascript:void(0);" onclick="deleteUser(event,'{{$user->id}}')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End: life time stats -->
                            </div>

                        </div>
                        <!-- Modal Html for Create User start -->

                        <div id="modal_create_user" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <form name="frm_user_add" id="frm_user_add" action="" method="post" data-remote="data-remote" class="form-horizontal two-column-layout-form">
                                    {!! csrf_field() !!}
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Create User</h4>
                                        </div>
                                        <div class="modal-body" style="padding-bottom: 0px;">
                                            <div class="modal_msg"></div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-5 control-label" for="username">Username<span class="required">*</span></label>
                                                <div class="col-xs-7">
                                                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" value="{{ old('firstname') }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-5 control-label" for="email">Email<span class="required">*</span></label>
                                                <div class="col-xs-7">
                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-5 control-label" for="firstname">Firstname<span class="required">*</span></label>
                                                <div class="col-xs-7">
                                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter firstname"  value="{{ old('firstname') }}">
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-5 control-label" for="lastname">Lastname<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-7">
                                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter lastname"  value="{{ old('lastname') }}">
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <!--<hr>-->
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-5 control-label" for="password">Password<span class="required">*</span></label>
                                                <div class="col-xs-7">
                                                    <input type="password" id="password" name="password" class="form-control"  placeholder="Enter password" autocomplete="off" >
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-5 control-label" for="password-confirm">Confirm Password<span class="required">*</span></label>
                                                <div class="col-xs-7">
                                                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Enter confirm password" autocomplete="off"  >
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit"  class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Html for Create User end -->

    @stop

    @section('page_level_plugins')

        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-form/jquery.form.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootbox/bootbox.min.js')}}"></script>

    @stop

    @section('page_level_scripts')
        <script src="{{ URL::asset('assets/global/scripts/datatable.js')}}"></script>
    @stop

    @section('footer')

        <script language="javascript">
            var csrf_token ='{{ csrf_token() }}';
            var url_users_datatable_ajax='{{ route('users-datatable-ajax') }}';
            var url_users='{{ route('users-home') }}';
        </script>
        <script src="{{ URL::asset('js/common.js')}}"></script>
        <script src="{{ URL::asset('pages/scripts/admin/users-index.js')}}"></script>

    @stop
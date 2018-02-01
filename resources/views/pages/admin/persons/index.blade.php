    @extends('layouts.app')

    @section('title', 'Persons')

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
                                            <span class="caption-subject font-blue-sharp bold uppercase">Persons</span>
                                            <span class="caption-helper">view & filter...</span>
                                        </div>
                                        <div class="actions">
                                            <a href="javascript:void(0);" id="anc_create_person" class="btn btn-default btn-circle">
                                                <i class="fa fa-plus"></i>
                                                <span class="hidden-480">
                                                    New Person
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
                                                        <th width="12%">
                                                            Name
                                                        </th>
                                                        <th >
                                                            Nickname
                                                        </th>
                                                        <th width="10%">
                                                            Birth Date
                                                        </th>
                                                         <th >
                                                            Address
                                                        </th>
                                                        <th width="13%">
                                                            Phone1
                                                        </th>
                                                        <th width="13%">
                                                            Phone2
                                                        </th>
                                                        <th width="13%">
                                                            Phone3
                                                        </th>
                                                        <th width="13%">
                                                            Email
                                                        </th>

                                                        <th class="no-sort" width="8%" style="min-width:60px;">
                                                            Actions
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($persons))
                                                        @foreach($persons as $person)
                                                        <tr>
                                                            <td>{{$person->name}}</td>
                                                            <td>{{$person->nickname}}</td>
                                                            <td>{{$person->birth_date_display}}</td>
                                                            <td>{{$person->address_display}}</td>
                                                            <td>{{$person->phone1_display}}</td>
                                                            <td>{{$person->phone2_display}}</td>
                                                            <td>{{$person->phone3_display}}</td>
                                                            <td>{{$person->email}}</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a href="javascript:void(0);" onclick="goToEditPage(event,'{{$person->id}}');" data-person-id="{{$person->id}}" class="btn btn-sm btn-primary btn-list-edit"><i class="fa fa-search"></i></a>
                                                                    <a href="javascript:void(0);" onclick="deletePerson(event,'{{$person->id}}')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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

                        <div id="modal_create_person" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <form name="frm_person_add" id="frm_person_add" action="" method="post" data-remote="data-remote" class="form-horizontal two-column-layout-form">
                                    {!! csrf_field() !!}
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Create Person</h4>
                                        </div>
                                        <div class="modal-body" style="padding-bottom: 0px;">
                                            <div class="modal_msg"></div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="prefix">Prefix<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="prefix" name="prefix" class="form-control" placeholder="Enter prefix" value="{{ old('prefix') }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="firstname">Firstname<span class="required">*</span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter firstname"  value="{{ old('firstname') }}">
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="middlename">Middlename<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="middlename" name="middlename" class="form-control" placeholder="Enter middlename"  value="{{ old('middlename') }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="lastname">Lastname<span class="required">*</span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter lastname"  value="{{ old('lastname') }}">
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                             <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="suffix">Suffix <span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="suffix" name="suffix" class="form-control" placeholder="Enter suffix" value="{{ old('suffix') }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="nickname">Nickname<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Enter nickname"  value="{{ old('nickname') }}">
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="pronounced">Pronounced <span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="pronounced" name="pronounced" class="form-control" placeholder="Enter pronounced"  value="{{ old('pronounced') }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="pronounced">Gender<span class="required">*</span></label>
                                                <div class="radio-list col-xs-8">
                                                    <label class="radio-inline">
                                                    <input type="radio" name="gender" id="optionsRadios4" value="Male" >Male</label>
                                                    <label class="radio-inline">
                                                    <input type="radio" name="gender" id="optionsRadios5" value="Female">Female</label>
                                                    <label class="radio-inline">
                                                    <input type="radio" name="gender" id="optionsRadios6" value="Other">Other</label>
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label">Birth Date<span class="required">*</span></label>
                                                <div class="col-xs-8">
                                                    <div class="input-group date date-picker" data-date-format="mm-dd-yyyy">
                                                        <input type="text" id="birth_date" name="birth_date" class="form-control" readonly >
                                                        <span class="input-group-btn">
                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="email">Email<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="street1">Street 1<span class="required">*</span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="street1" name="street1" class="form-control" placeholder="Enter street" value="{{ old('street1') }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="street2">Street 2<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="street2" name="street2" class="form-control" placeholder="Enter street"  value="{{ old('street2') }}">
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="city">City<span class="required">*</span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="city" name="city" class="form-control" placeholder="Enter city" value="{{ old('city') }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="state">State<span class="required">*</span></label>
                                                <div class="col-xs-8">
                                                    <select  id="state" name="state" class="form-control">
                                                        <option value="">Select State</option>
                                                        @if(count($states))
                                                            @foreach($states as $state_code=>$state_name)
                                                                <option value="{{$state_code}}">{{$state_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group ">
                                                <label class="col-xs-4 col-sm-4 col-lg-4 control-label" for="zip">Zip<span class="required">*</span></label>
                                                <div class="col-xs-8 custom-zip-group">
                                                    <div class="col-xs-7">
                                                        <input type="text" id="zip" name="zip"  class="form-control" placeholder="Enter zip" value="{{ old('zip') }}">
                                                    </div>
                                                    <div class="col-xs-4 col-sm-4 col-lg-4">
                                                        <input type="text" id="zip_ext" name="zip_ext" class="form-control" placeholder="Ext" value="{{ old('zip_ext') }}">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                                <label class="col-xs-4 control-label" for="county">County<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8">
                                                    <input type="text" id="county" name="county" class="form-control" placeholder="Enter county"  value="{{ old('county') }}">
                                                </div>
                                            </div>
                                            <span class="clearfix"></span>
                                            <div class="form-group ">
                                                <label class="col-xs-4 col-sm-2 col-lg-2 control-label" for="phone1">Phone1<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8 custom-phone-group">
                                                    <div class="col-xs-5">
                                                        <input type="text" id="phone1" name="phone1" class="form-control" placeholder="Enter phone" value="{{ old('phone1') }}">
                                                    </div>
                                                    <div class="col-xs-3 col-sm-2 col-lg-2">
                                                        <input type="text" id="phone1_ext" name="phone1_ext" class="form-control" placeholder="Ext" value="{{ old('phone1_ext') }}">
                                                    </div>
                                                    <div class="col-xs-3 col-sm-2 col-lg-2">
                                                        <select id="phone1_type" name="phone1_type" class="form-control">
                                                           <option value="">Type</option>
                                                           <option value="Home">Home</option>
                                                           <option value="Work">Work</option>
                                                           <option value="Mobile">Mobile</option>
                                                           <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-xs-4 col-sm-2 col-lg-2 control-label" for="phone2">Phone2<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8 custom-phone-group">
                                                    <div class="col-xs-5">
                                                        <input type="text" id="phone2" name="phone2" class="form-control" placeholder="Enter phone" value="{{ old('phone2') }}">
                                                    </div>
                                                    <div class="col-xs-3 col-sm-2 col-lg-2">
                                                        <input type="text" id="phone2_ext" name="phone2_ext" class="form-control" placeholder="Ext" value="{{ old('phone2_ext') }}">
                                                    </div>
                                                    <div class="col-xs-3 col-sm-2 col-lg-2">
                                                        <select id="phone2_type" name="phone2_type" class="form-control">
                                                           <option value="">Type</option>
                                                           <option value="Home">Home</option>
                                                           <option value="Work">Work</option>
                                                           <option value="Mobile">Mobile</option>
                                                           <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-xs-4 col-sm-2 col-lg-2 control-label" for="phone3">Phone3<span class="required"> &nbsp; </span></label>
                                                <div class="col-xs-8 custom-phone-group">
                                                    <div class="col-xs-5">
                                                        <input type="text" id="phone3" name="phone3" class="form-control" placeholder="Enter phone" value="{{ old('phone3') }}">
                                                    </div>
                                                    <div class="col-xs-3 col-sm-2 col-lg-2">
                                                        <input type="text" id="phone3_ext" name="phone3_ext" class="form-control" placeholder="Ext" value="{{ old('phone3_ext') }}">
                                                    </div>
                                                    <div class="col-xs-3 col-sm-2 col-lg-2">
                                                        <select id="phone3_type" name="phone3_type" class="form-control">
                                                           <option value="">Type</option>
                                                           <option value="Home">Home</option>
                                                           <option value="Work">Work</option>
                                                           <option value="Mobile">Mobile</option>
                                                           <option value="Other">Other</option>
                                                        </select>
                                                    </div>
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
            var url_persons='{{ route('persons-home') }}';
        </script>
        <script src="{{ URL::asset('js/common.js')}}"></script>
        <script src="{{ URL::asset('js/jquery-validate-additional-methods-custom.js')}}"></script>
        <script src="{{ URL::asset('pages/scripts/admin/persons-index.js')}}"></script>

    @stop
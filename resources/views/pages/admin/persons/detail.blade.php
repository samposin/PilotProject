    @extends('layouts.app')

    @section('title', $person->name)

    @section('page_level_styles')

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('pages/css/profile.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"/>

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
                            <form class="form-horizontal two-column-layout-form" name="frm_person_edit" id="frm_person_edit" action="" method="post" novalidate="novalidate">
                                <input type="hidden" name="hdn_person_id" id="hdn_person_id" value="{{$person->id}}">
                                {!! csrf_field() !!}
                                <div class="portlet light">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-equalizer font-blue-madison"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Person Information</span>
                                        </div>
                                        <div class="actions">
                                            <a href="javascript:void(0);" id="anc_edit_person" class="btn btn-default btn-circle display_value_section">
                                                <i class="fa fa-pencil"></i>
                                                <span class="hidden-480">Edit</span>
                                            </a>
                                            <a class="btn blue-madison btn-circle btn-sm" href="{{url('admin/persons')}}"> <i class="fa fa-arrow-left"></i> Back</a>
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
                                            <label class="col-xs-4 control-label" for="prefix">Prefix<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="prefix" name="prefix" class="form-control" placeholder="Enter prefix" value="{{$person->prefix}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->prefix}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="firstname">Firstname<span class="required">*</span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter firstname"  value="{{$person->firstname}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->firstname}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="middlename">Middlename<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="middlename" name="middlename" class="form-control" placeholder="Enter middlename"  value="{{$person->middlename}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->middlename}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="lastname">Lastname<span class="required">*</span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter lastname"  value="{{$person->lastname}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->lastname}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                         <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="suffix">Suffix <span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="suffix" name="suffix" class="form-control" placeholder="Enter suffix" value="{{$person->suffix}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->suffix}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="nickname">Nickname<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Enter nickname"  value="{{$person->nickname}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->nickname}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="pronounced">Pronounced <span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="pronounced" name="pronounced" class="form-control" placeholder="Enter pronounced"  value="{{$person->pronounced}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->pronounced}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" >Gender<span class="required">*</span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <div class="radio-list">
                                                        <label class="radio-inline">
                                                        <input type="radio" name="gender" id="gender1" value="Male" {{ $person->gender=='Male' ? 'checked' : '' }} >Male</label>
                                                        <label class="radio-inline">
                                                        <input type="radio" name="gender" id="gender2" value="Female" {{ $person->gender=='Female' ? 'checked' : '' }}>Female</label>
                                                        <label class="radio-inline">
                                                        <input type="radio" name="gender" id="gender3" value="Other" {{ $person->gender=='Other' ? 'checked' : '' }}>Other</label>
                                                    </div>
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->gender}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="birth_date">Birth Date<span class="required">*</span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                     <div class="input-group date date-picker" data-date-format="mm-dd-yyyy">
                                                        <input type="text" id="birth_date" name="birth_date" class="form-control" readonly value="{{$person->birth_date_display}}" >
                                                        <span class="input-group-btn">
                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->birth_date_display}}
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="email">Email<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" value="{{$person->email}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->email}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="street1">Street 1<span class="required">*</span></label>
                                            <div class="col-xs-8">
                                                 <div class="controls display_control_section">
                                                    <input type="text" id="street1" name="street1" class="form-control" placeholder="Enter street" value="{{$person->street1}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->street1}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="street2">Street 2<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                    <input type="text" id="street2" name="street2" class="form-control" placeholder="Enter street"  value="{{$person->street2}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->street2}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="city">City<span class="required">*</span></label>
                                            <div class="col-xs-8">
                                                 <div class="controls display_control_section">
                                                    <input type="text" id="city" name="city" class="form-control" placeholder="Enter city" value="{{$person->city}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->city}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="state">State<span class="required">*</span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                     <select  id="state" name="state" class="form-control">
                                                        <option value="">Select State</option>
                                                        @if(count($states))
                                                            @foreach($states as $state_code=>$state_name)
                                                                 @if($person->state==$state_code)
                                                                <option value="{{$state_code}}"  selected="selected">{{$state_name}}</option>
                                                                @else
                                                                <option value="{{$state_code}}" >{{$state_name}}</option>
                                                            @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->state}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group ">
                                            <label class="col-xs-4 col-sm-4 col-lg-4 control-label" for="zip">Zip<span class="required">*</span></label>
                                            <div class="col-xs-8">
                                                <div class="controls display_control_section">
                                                     <div class="custom-zip-group">
                                                        <div class="col-xs-7">
                                                            <input type="text" id="zip" name="zip"  class="form-control" placeholder="Enter zip" value="{{$person->zip}}">
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4 col-lg-4">
                                                            <input type="text" id="zip_ext" name="zip_ext" class="form-control" placeholder="Ext" value="{{$person->zip_ext}}">

                                                        </div>
                                                        <span class="clearfix"></span>
                                                     </div>
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->zip_display}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-lg-6 form-group">
                                            <label class="col-xs-4 control-label" for="county">County<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8">
                                                 <div class="controls display_control_section">
                                                    <input type="text" id="county" name="county" class="form-control" placeholder="Enter county"  value="{{$person->county}}">
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->county}}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="clearfix"></span>
                                        <div class="form-group ">
                                            <label class="col-xs-4 col-sm-2 col-lg-2 control-label" for="phone1">Phone1<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8 ">
                                                <div class="controls display_control_section">
                                                    <div class="custom-phone-group">
                                                        <div class="col-xs-5">
                                                            <input type="text" id="phone1" name="phone1" class="form-control" placeholder="Enter phone" value="{{$person->phone1}}">
                                                        </div>
                                                        <div class="col-xs-3 col-sm-2 col-lg-2">
                                                            <input type="text" id="phone1_ext" name="phone1_ext" class="form-control" placeholder="Ext" value="{{$person->phone1_ext}}">
                                                        </div>
                                                        <div class="col-xs-3 col-sm-2 col-lg-2">
                                                            <select id="phone1_type" name="phone1_type" class="form-control">
                                                               <option value="">Type</option>
                                                               <option value="Home"   {{$person->phone1_type=='Home' ? 'selected' : ''}}>Home</option>
                                                               <option value="Work"   {{$person->phone1_type=='Work' ? 'selected' : ''}}>Work</option>
                                                               <option value="Mobile" {{$person->phone1_type=='Mobile' ? 'selected' : ''}}>Mobile</option>
                                                               <option value="Other"  {{$person->phone1_type=='Other' ? 'selected' : ''}}>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->phone1_display}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-xs-4 col-sm-2 col-lg-2 control-label" for="phone2">Phone2<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8 ">
                                                 <div class="controls display_control_section">
                                                    <div class="custom-phone-group">
                                                        <div class="col-xs-5">
                                                            <input type="text" id="phone2" name="phone2" class="form-control" placeholder="Enter phone" value="{{ $person->phone2 }}">
                                                        </div>
                                                        <div class="col-xs-3 col-sm-2 col-lg-2">
                                                            <input type="text" id="phone2_ext" name="phone2_ext" class="form-control" placeholder="Ext" value="{{ $person->phone2_ext }}">
                                                        </div>
                                                        <div class="col-xs-3 col-sm-2 col-lg-2">
                                                            <select id="phone2_type" name="phone2_type" class="form-control">
                                                               <option value="">Type</option>
                                                               <option value="Home"   {{$person->phone2_type=='Home' ? 'selected' : ''}}>Home</option>
                                                               <option value="Work"   {{$person->phone2_type=='Work' ? 'selected' : ''}}>Work</option>
                                                               <option value="Mobile" {{$person->phone2_type=='Mobile' ? 'selected' : ''}}>Mobile</option>
                                                               <option value="Other"  {{$person->phone2_type=='Other' ? 'selected' : ''}}>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->phone2_display}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-xs-4 col-sm-2 col-lg-2 control-label" for="phone3">Phone3<span class="required"> &nbsp; </span></label>
                                            <div class="col-xs-8 ">
                                                 <div class="controls display_control_section">
                                                    <div class="custom-phone-group">
                                                        <div class="col-xs-5">
                                                            <input type="text" id="phone3" name="phone3" class="form-control" placeholder="Enter phone" value="{{ $person->phone3 }}">
                                                        </div>
                                                        <div class="col-xs-3 col-sm-2 col-lg-2">
                                                            <input type="text" id="phone3_ext" name="phone3_ext" class="form-control" placeholder="Ext" value="{{ $person->phone3_ext }}">
                                                        </div>
                                                        <div class="col-xs-3 col-sm-2 col-lg-2">
                                                            <select id="phone3_type" name="phone3_type" class="form-control">
                                                               <option value="">Type</option>
                                                               <option value="Home"   {{$person->phone3_type=='Home' ? 'selected' : ''}}>Home</option>
                                                               <option value="Work"   {{$person->phone3_type=='Work' ? 'selected' : ''}}>Work</option>
                                                               <option value="Mobile" {{$person->phone3_type=='Mobile' ? 'selected' : ''}}>Mobile</option>
                                                               <option value="Other"  {{$person->phone3_type=='Other' ? 'selected' : ''}}>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="display_value_section control-label">
                                                    {{$person->phone3_display}}
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
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    @stop

    @section('page_level_scripts')

    @stop

    @section('footer')

        <script language="javascript">
            var csrf_token ='{{ csrf_token() }}';
            var url_persons='{{ route('persons-home') }}';

        </script>
        <script src="{{ URL::asset('js/common.js')}}"></script>
        <script src="{{ URL::asset('js/jquery-validate-additional-methods-custom.js')}}"></script>
        <script src="{{ URL::asset('pages/scripts/admin/person-detail.js')}}"></script>

    @stop

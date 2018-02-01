    @extends('layouts.app')

    @section('title', 'Dashboard')

    @section('page_level_styles')

    @stop

    @section('page_level_custom_styles')
        <link href="{{ URL::asset('css/custom.css')}}" rel="stylesheet" type="text/css"/>
    @stop

    @section('content')

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2" data-url="{{url('admin/users')}}">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">{{$total_users}}</h3>
                                        <small>NUMBER OF USERS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2" data-url="{{url('admin/persons')}}">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">{{$total_persons}}</h3>
                                        <small>NUMBER OF PERSONS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    @stop

    @section('page_level_plugins')

    @stop

    @section('page_level_scripts')
        <script src="{{ URL::asset('assets/global/scripts/datatable.js')}}"></script>
    @stop

    @section('footer')

        <script language="javascript">
            jQuery('.dashboard-stat2').each(function(){
                jQuery(this).on("click",function(){
                    var data_url=jQuery(this).data("url");
                    location.href=data_url;
                });
            });
        </script>

    @stop
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="start {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fa fa-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                            <a href="{{url('admin/users')}}">
                                <i class="fa fa-user"></i>
                                <span class="title">Users</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/persons*') ? 'active' : '' }}">
                            <a href="{{url('admin/persons')}}">
                                <i class="fa fa-user"></i>
                                <span class="title">Persons</span>
                            </a>
                        </li>

                        @if(count($recent_viewed_persons_arr))

                        <li class="heading">
                            <h3 class="uppercase">Recent Persons</h3>
                        </li>

                        @foreach($recent_viewed_persons_arr as $recent_viewed_person)

                        <li>
                            <a href="{{url('admin/persons/'.$recent_viewed_person['id'])}}">
                                <i class="fa fa-user"></i> <span class="title">{{$recent_viewed_person['name']}}</span>
                            </a>
                        </li>

                        @endforeach
                        @endif
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
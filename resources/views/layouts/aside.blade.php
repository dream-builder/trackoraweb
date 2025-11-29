<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand" style="justify-content: left;">
        <!--begin::Brand Link-->
        <a href="/" class="brand-link">
            <!--begin::Brand Image-->
            {{-- <img src="adminlte3/assets/img/logo.svg" alt="School Bus Tracker" class="brand-image opacity-75 shadow" /> --}}
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            {{-- <i class="nav-icon bi bi-bus-front-fill" style="color: yellow"></i> --}}
            <img src="images/trackora_logo_s.png" style="width: 30px; border-radius:5px;"> <span
                class="brand-text fw-light">{{ config('app.name') }}</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <?php $role_name = session('user_role')->role_name; ?>

                {{-- Dashboard --}}
                @if ($role_name == 'Admin' || $role_name == 'Viewer')
                    <li class="nav-item ">
                        <a href="{{ route('dashboard') }}" class="nav-link ">
                            <i class="nav-icon bi bi-display"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>
                @endif



                {{-- Manage student  --}}
                @if ($role_name == 'Admin')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-diagram-2-fill"></i>
                            <p>
                                Student Management
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('student.create') }}" class="nav-link">
                                    <i class="nav-icon bi bi-mortarboard-fill"></i>
                                    <p>Add Student</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('student.show') }}" class="nav-link">
                                    <i class="nav-icon bi bi-mortarboard-fill"></i>
                                    <p>Show All Student</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('student.registertoroute') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Register Student to Route</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="./widgets/info-box.html" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Guardian</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                @endif

                {{-- Bus Management --}}
                @if ($role_name == 'Admin')
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-bus-front-fill"></i>
                            <p>
                                BUS Managemet
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bus.show') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Bus list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('bus.addnew') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Add new bus </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('bus.addtobus') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Add student to Bus </p>
                                </a>
                            </li>


                        </ul>
                    </li> --}}
                @endif

                {{-- Driver Management --}}
                @if ($role_name == 'Admin' || $role_name == 'Driver')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-person-bounding-box"></i>
                            <p>
                                Driver Managemet
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('driver.dashboard') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('driver.show') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Driver list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('driver.addnew') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Add new driver </p>
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                            <a href="{{ route('driver.assignvehicle') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Assign Vehicle</p>
                            </a>
                        </li> --}}



                        </ul>
                    </li>
                @endif

                {{-- Route Management --}}
                @if ($role_name == 'Admin')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-sign-turn-slight-right-fill"></i>
                            <p>
                                Route Management
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('route.show') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Create</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

                {{-- User Management --}}
                @if ($role_name == 'Admin')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-people-fill"></i>
                            <p>
                                User Managment
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./forms/general.html" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>General Elements</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Role Management --}}
                @if ($role_name == 'Admin')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-universal-access-circle"></i>
                            <p>
                                Roles
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./tables/simple.html" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Simple Tables</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Settings --}}
                @if ($role_name == 'Admin')
                    <li class="nav-item">
                        <a href="./docs/introduction.html" class="nav-link">
                            <i class="nav-icon bi bi-gear-fill"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                @endif

                {{-- Demo --}}
                @if ($role_name == 'Admin' || $role_name == 'Viewer')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-diagram-2-fill"></i>
                            <p>
                                Demo
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('live.update_bus_demo') }}" class="nav-link">
                                    <i class="nav-icon bi bi-mortarboard-fill"></i>
                                    <p>Bus</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('student.show') }}" class="nav-link">
                                    <i class="nav-icon bi bi-mortarboard-fill"></i>
                                    <p>Student</p>
                                </a>
                            </li>


                        </ul>


                    </li>
                @endif



            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

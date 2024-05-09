<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu d-none d-lg-block">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            @php
                $route = Route::currentRouteName();
                $user  = Auth::user();
            @endphp

            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Dashboard</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="icon-accelerator"></i><span> Dashboard </span>
                    </a>
                </li>

                @if (Auth::user()->hasPermission('roles.index') || Auth::user()->hasPermission('users.index'))
                <li class="menu-title">Authorization</li>
                @endif

                @if (Auth::user()->hasPermission('roles.index'))
                    <li class="{{ $route == 'roles.edit' || $route == 'roles.create' || $route == 'roles.show' ? 'mm-active' : '' }}">
                        <a href="{{ route('roles.index') }}" class="waves-effect {{ $route == 'roles.edit' || $route == 'roles.create' || $route == 'roles.show' ? 'mm-active' : '' }}">
                            <i class="icon-check"></i>
                            <span> Role</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasPermission('users.index'))
                    <li class="{{ $route == 'users.edit' || $route == 'users.create' || $route == 'users.show' ? 'mm-active' : '' }}">
                        <a href="{{ route('users.index') }}" class="waves-effect {{ $route == 'users.edit' || $route == 'users.create' || $route == 'users.show' ? 'mm-active' : '' }}">
                            <i class="icon-profile"></i>
                            <span> User</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasPermission('attendance.index') || Auth::user()->hasPermission('my.attendance') || Auth::user()->hasPermission('reconciliations.index') || Auth::user()->hasPermission('pending.reconciliation'))
                <li class="menu-title">main</li>
                @endif

                @if (Auth::user()->hasPermission('attendance.index') || Auth::user()->hasPermission('attendance.details') || Auth::user()->hasPermission('attendance.report') || Auth::user()->hasPermission('my.attendance') || Auth::user()->hasPermission('my.attendance.report'))
                <li class="{{ $route == 'attendance.index' || $route == 'attendance.details' || $route == 'attendance.report' || $route == 'my.attendance' || $route == 'my.attendance.report' ? 'mm-active' : '' }}">
                    <a href="javascript:void(0);" class="waves-effect {{ $route == 'attendance.index' || $route == 'attendance.details' || $route == 'attendance.report' || $route == 'my.attendance' || $route == 'my.attendance.report' ? 'mm-active' : '' }}">
                        <i class="icon-diamond"></i>
                        <span> Attendance
                            <span class="float-right menu-arrow">
                                <i class="mdi mdi-chevron-right"></i>
                            </span>
                        </span>
                    </a>
                    <ul class="submenu">
                        @if (Auth::user()->hasPermission('attendance.index') || Auth::user()->hasPermission('attendance.details') || Auth::user()->hasPermission('attendance.report'))
                            <li class="{{ $route == 'attendance.index' || $route == 'attendance.details' ||  $route == 'machine.attendance.report' || $route == 'attendance.report' ? 'mm-active' : '' }}">
                                <a href="{{ route('machine.attendance.report') }}">Attendance</a>
                            </li>
                        @endif

                        {{-- @if (Auth::user()->hasPermission('my.attendance') || Auth::user()->hasPermission('my.attendance.report'))
                            @if ($user->role_id == 2)
                                <li class="{{ $route == 'my.attendance' || $route == 'my.attendance.report' ? 'mm-active' : '' }}">
                                    <a href="{{ route('my.attendance') }}">My Attendance</a>
                                </li>
                            @endif
                        @endif --}}
                    </ul>
                </li>
                @endif

{{--
                @if (Auth::user()->hasPermission('reconciliations.index') || Auth::user()->hasPermission('reconciliations.create') || Auth::user()->hasPermission('pending.reconciliation'))
                <li class="{{ $route == 'reconciliations.index' || $route == 'reconciliations.create' || $route == 'pending.reconciliation' ? 'mm-active' : '' }}">
                    <a href="javascript:void(0);" class="waves-effect {{ $route == 'reconciliations.index' || $route == 'reconciliations.create' || $route == 'pending.reconciliation' ? 'mm-active' : '' }}">
                        <i class="icon-diamond"></i>
                        <span> Reconciliation
                            <span class="float-right menu-arrow">
                                <i class="mdi mdi-chevron-right"></i>
                            </span>
                        </span>
                    </a>
                    <ul class="submenu">
                        @if (Auth::user()->hasPermission('reconciliations.index') || Auth::user()->hasPermission('reconciliations.create'))
                            <li class="{{ $route == 'reconciliations.index' || $route == 'reconciliations.create' ? 'mm-active' : '' }}">
                                <a href="{{ route('reconciliations.index') }}">Reconciliation</a>
                            </li>
                        @endif

                        @if (Auth::user()->hasPermission('pending.reconciliation'))
                            @if ($user->role_id != 2)
                                <li class="{{ $route == 'pending.reconciliation' ? 'mm-active' : '' }}">
                                    <a href="{{ route('pending.reconciliation') }}">Pending Reconciliation</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </li>
                @endif

                @if (Auth::user()->hasPermission('departments.index'))
                <li class="menu-title">lookup</li>
                @endif

                @if (Auth::user()->hasPermission('departments.index'))
                <li>
                    <a href="{{ route('departments.index') }}" class="waves-effect">
                        <i class="icon-diamond"></i>
                        <span> Department</span>
                    </a>
                </li>
                @endif --}}
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->

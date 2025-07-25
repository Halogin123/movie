<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('adminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ducnm</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if (\Request::is('/')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Trang chính</p>
                    </a>
                </li>

                <li class="nav-item @if(
                        Request::is('stocks*') ||
                        Request::is('dashboard-stock') ||
                        Request::is('stock-transactions*') ||
                        Request::is('fund-certificates*')
                        ) menu-open menu-is-opening @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Chứng khoán
                            <i class="fas fa-angle-left right"></i>
{{--                            <span class="badge badge-info right">6</span>--}}
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard-stock') }}" class="nav-link @if (Request::is('dashboard-stock')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Báo cái tài chính</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stocks.index') }}" class="nav-link @if (Request::is('stocks*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cổ phiếu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fund-certificates.index') }}" class="nav-link @if (Request::is('fund-certificates*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chứng chỉ quỹ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stock-transactions.index') }}" class="nav-link @if (Request::is('stock-transactions*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Giao dịch</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if(Request::is('asset*')) menu-open menu-is-opening @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Tài sản
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('asset.index') }}" class="nav-link @if (Request::is('asset*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tài sản</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('asset-categories.index') }}" class="nav-link @if (Request::is('asset-categories*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nhóm tài sản</p>
                            </a>
                        </li>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->can('create-transactions'))
                            <li class="nav-item">
                                <a href="{{ route('transactions.index') }}" class="nav-link @if (Request::is('transactions*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Giao dịch</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                @if(auth()->user()->hasRole('admin'))
                    <li class="nav-item @if(Request::is('system*')) menu-open menu-is-opening @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Cấu hình hệ thống
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('group-permission.index') }}" class="nav-link @if (Request::is('group-permission*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nhóm quyền</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permission.index') }}" class="nav-link @if (Request::is('permission*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Phân quyền</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('logip.index') }}" class="nav-link @if (\Request::is('logip')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Log Ip</p>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

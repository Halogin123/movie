<header id="header">
    <div id="navbar">
        <div class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-action="toggleCollapsable">
                    <span class="fas fa-bars"></span>
                </button>
                <div class="navbar-logo-container">
                    <a class="navbar-brand nav-link" href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/images/Aladdin_login_logo.png') }}" class="logo">
                    </a>
                </div>
                <a role="button" class="side-menu-button"><span class="fas fa-bars"></span></a>
            </div>

            <div class="navbar-collapse navbar-body">
                <ul class="nav navbar-nav tabs" style="height: 581px;">
                    <li data-name="Home" class="not-in-more tab @if (\Request::is('/')) active @endif">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <span class="short-label" title="Trang chính">
                                <span class="fas fa-th-large"></span>
                            </span>
                            <span class="full-label">Trang chính</span>
                        </a>
                    </li>
                    @can('admin')
                        <li data-name="ShoppingReason" class="not-in-more tab @if (\Request::is('shopping-reason')) active @endif">
                            <a href="{{ route('shopping-reason.index') }}" class="nav-link" style="border-color: #a4c5e0">
                            <span class="short-label" title="Lý do mua sắm" style="color: #a4c5e0">
                                <span class="fas fa-id-badge"></span>
                            </span>
                                <span class="full-label">Lý do mua sắm</span>
                            </a>
                        </li>
                    @endcan
                    <li data-name="ShoppingRequest" class="not-in-more tab @if (\Request::is('shopping-request')) active @endif">
                        <a href="{{ route('purchase-order') }}" class="nav-link" style="border-color: #a4c5e0">
                            <span class="short-label" title="Lý do mua sắm" style="color: #a4c5e0">
                                <span class="fas fa-id-badge"></span>
                            </span>
                            <span class="full-label">Yêu cầu mua sắm</span>
                        </a>
                    </li>
                    <li data-name="ShoppingRequest" class="not-in-more tab @if (\Request::is('process-group')) active @endif">
                        <a href="{{ route('process-group.index') }}" class="nav-link" style="border-color: #a4c5e0">
                            <span class="short-label" title="Nhóm quy trình" style="color: #a4c5e0">
                                <span class="fas fa-id-badge"></span>
                            </span>
                            <span class="full-label">Nhóm quy trình</span>
                        </a>
                    </li>
                    <li data-name="ShoppingRequest" class="not-in-more tab @if (\Request::is('process')) active @endif">
                        <a href="{{ route('process.index') }}" class="nav-link" style="border-color: #a4c5e0">
                            <span class="short-label" title="Nhóm quy trình" style="color: #a4c5e0">
                                <span class="fas fa-id-badge"></span>
                            </span>
                            <span class="full-label">Quy trình</span>
                        </a>
                    </li>
                </ul>
                <div class="navbar-right-container">
                    <ul class="nav navbar-nav navbar-right shadowed">
                        <li class="dropdown hidden-xs quick-create-container">
                            <a id="nav-quick-create-dropdown" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" tabindex="0" title="Tạo"><i class="fas fa-plus"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="nav-quick-create-dropdown">
                                <li class="dropdown-header">Tạo</li>
                                <li><a href="#Account/create" data-name="Account" data-action="quick-create">Tài
                                        khoản</a></li>
                                <li><a href="#Contact/create" data-name="Contact" data-action="quick-create">Liên hệ</a>
                                </li>
                                <li><a href="#Lead/create" data-name="Lead" data-action="quick-create">Chỉ dẫn</a></li>
                                <li><a href="#Opportunity/create" data-name="Opportunity" data-action="quick-create">Cơ
                                        hội</a></li>
                                <li><a href="#Meeting/create" data-name="Meeting" data-action="quick-create">Buổi
                                        gặp</a></li>
                                <li><a href="#Call/create" data-name="Call" data-action="quick-create">Gọi</a></li>
                                <li><a href="#Task/create" data-name="Task" data-action="quick-create">Nhiệm vụ</a></li>
                                <li><a href="#Case/create" data-name="Case" data-action="quick-create">Trường hợp</a>
                                </li>
                                <li><a href="#Email/create" data-name="Email" data-action="quick-create">Email</a></li>
                            </ul>
                        </li>
                        <li class="dropdown notifications-badge-container">
                            <a role="button" tabindex="0" class="notifications-button" data-action="showNotifications"
                               title="Thông báo">
                                <span class="fas fa-bell icon bell"></span>
                                <span class="badge number-badge hidden"></span>
                            </a>
                            <div class="notifications-panel-container"></div>

                        </li>
                        <li class="dropdown menu-container">
                            <a id="nav-menu-dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               tabindex="0" title="Menu"><span class="fas fa-ellipsis-v"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="nav-menu-dropdown">
                                <li><a href="#User/view/64daeb086a2019cf9" tabindex="0" class="nav-link"><img
                                            src="?entryPoint=avatar&amp;size=small&amp;id=64daeb086a2019cf9&amp;t=1692260635782"
                                            class="avatar avatar-link" width="16"> {{ Auth::user()->name }}</a></li>
                                <li class="divider"></li>
                                <li><a href="#Admin" tabindex="0" class="nav-link">Quản trị</a></li>
                                <li><a href="#Preferences" tabindex="0" class="nav-link">Tùy chỉnh</a></li>
                                <li class="divider"></li>
                                <li><a href="#LastViewed" tabindex="0" class="nav-link action"
                                       data-action="showLastViewed">Đã xem gần đây</a></li>
                                <li class="divider"></li>
                                <li><a href="#About" tabindex="0" class="nav-link">Thông tin</a></li>
                                <li><a href="{{ route('logout') }}" tabindex="0" class="nav-link action" data-action="logout">Đăng
                                        xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <a class="minimizer" role="button" tabindex="0">
                    <span class="fas fa-chevron-right right"></span>
                    <span class="fas fa-chevron-left left"></span>
                </a>
            </div>
        </div>
    </div>
</header>

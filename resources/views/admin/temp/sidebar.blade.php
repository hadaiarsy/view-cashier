<div id="appSidebar" class="app-sidebar sidebar-shadow bg-deep-blue sidebar-text-dark">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                {{-- <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="javascript:void(0);" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li> --}}
                <li class="app-sidebar__heading">Transaksi</li>
                <li>
                    <a href="{{ route('transaksi') }}" class="{{ $sideTitle == 'transaksi' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-cart"></i>
                        Transaksi
                    </a>
                </li>
                <li class="app-sidebar__heading">Piutang</li>
                <li>
                    <a href="{{ route('piutang') }}" class="{{ $sideTitle == 'piutang' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-hammer"></i>
                        Piutang
                    </a>
                </li>
                <li class="app-sidebar__heading">Laporan</li>
                <li>
                    <a href="{{ route('laporan') }}" class="{{ $sideTitle == 'laporan' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-wallet"></i>
                        Laporan
                    </a>
                </li>
                <li class="app-sidebar__heading">Barang</li>
                <li>
                    <a href="{{ route('barang') }}" class="{{ $sideTitle == 'barang' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-box1"></i>
                        Info Barang
                    </a>
                </li>
                <li class="app-sidebar__heading">Member</li>
                <li>
                    <a href="{{ route('member') }}" class="{{ $sideTitle == 'member' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Info Member
                    </a>
                </li>
                @if ($level == 1)
                    <li class="app-sidebar__heading">User</li>
                    <li>
                        <a href="{{ route('user') }}" class="{{ $sideTitle == 'user' ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Info User
                        </a>
                    </li>
                @endif
        </div>
    </div>
</div>

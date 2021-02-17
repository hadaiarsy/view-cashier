<div id="appSidebar" class="app-sidebar sidebar-shadow">
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
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="javascript:void(0);" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard Info
                    </a>
                </li>
                <li class="app-sidebar__heading">Transaksi</li>
                <li>
                    <a href="{{ route('transaksi') }}" class="mm-active">
                        <i class="metismenu-icon pe-7s-cart"></i>
                        Penjualan
                    </a>
                </li>
        </div>
    </div>
</div>

<script>
    let sideBarStyle = document.getElementById('appSidebar');
    sideBarStyle.classList.add('bg-deep-blue');
    sideBarStyle.classList.add('sidebar-text-dark');

</script>

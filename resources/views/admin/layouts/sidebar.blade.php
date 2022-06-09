<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-sticky-note"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My Journal</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(Request::segment(2)=="dashboard") active @endif">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        İçerik Yönetimi
    </div>

    <!-- Nav Item - Articles Collapse Menu -->
    <li class="nav-item @if(Request::segment(2)=="articles") active @endif">
        <a class="nav-link @if(Request::segment(2)=="articles") in @else collapsed @endif" href="#"
           data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-edit"></i>
            <span>Makaleler</span>
        </a>
        <div id="collapseTwo" class="collapse @if(Request::segment(2)=="articles") show @endif"
             aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Makale İşlemleri:</h6>
                <a class="collapse-item @if(Request::segment(2)=="articles" & !Request::segment(3)) active @endif"
                   href="{{route('admin.articles.index')}}">Tüm Makaleler</a>
                <a class="collapse-item @if(Request::segment(2)=="articles" & Request::segment(3)=="create") active @endif"
                   href="{{route('admin.articles.create')}}">Makaler Oluştur</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Categories Collapse Menu -->
    <li class="nav-item @if(Request::segment(2)=="categories") active @endif">
        <a class="nav-link" href="{{route('admin.category.index')}}">
            <i class="fas fa-fw fa-list-ul"></i>
            <span>Kategoriler</span>
        </a>
    </li>

    <!-- Nav Item - Articles Collapse Menu -->
    <li class="nav-item @if(Request::segment(2)=="pages") active @endif">
        <a class="nav-link @if(Request::segment(2)=="pages") in @else collapsed @endif" href="#"
           data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Sayfalar</span>
        </a>
        <div id="collapsePages" class="collapse @if(Request::segment(2)=="pages") show @endif"
             aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sayfa İşlemleri:</h6>
                <a class="collapse-item @if(Request::segment(2)=="pages" & !Request::segment(3)) active @endif"
                   href="{{route('admin.page.index')}}">Tüm Sayfalar</a>
                <a class="collapse-item @if(Request::segment(2)=="pages" & Request::segment(3)=="create") active @endif"
                   href="{{route('admin.page.create')}}">Sayfa Oluştur</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Ayarlar
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(Request::segment(2)=="configs") active @endif">
        <a class="nav-link" href="{{route('admin.config.index')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Ayarlar</span>
        </a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    {{--    <div class="sidebar-card d-none d-lg-flex">--}}
    {{--        <img class="sidebar-card-illustration mb-2" src="{{asset('admin')}}/img/undraw_rocket.svg" alt="...">--}}
    {{--        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and--}}
    {{--            more!</p>--}}
    {{--        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>--}}
    {{--    </div>--}}

</ul>
<!-- End of Sidebar -->

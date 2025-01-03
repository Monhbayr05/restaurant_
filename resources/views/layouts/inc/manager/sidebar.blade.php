<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Менежэр</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{route('manager.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Хяналтын самбар</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{route('manager.table.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Ширээ</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{route('manager.order.index')}}">
            <i class="bi bi-border-style"></i>
            <span>Захиалга</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">







    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

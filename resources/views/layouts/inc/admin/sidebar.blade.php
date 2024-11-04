<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">АДМИН</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Хяналтын самбар</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-file-alt"></i>
            <span>Тайлан</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- users  -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-user-tie"></i>
            <span>Хэрэглэгчид</span></a>
    </li>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{Route('admin.restaurant.index')}}">
            <i class="fas fa-utensils"></i>
            <span>Ресторан</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.table.index') }}">
            <i class="fas fa-chair"></i>
            <span>Ширээ</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.category.index') }}">
            <i class="fas fa-th-list"></i>
            <span>Категори</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.product.index') }}">
            <i class="fas fa-pizza-slice"></i>
            <span>Бүтээгдэхүүн</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-receipt"></i>
            <span>Захиалга</span></a>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{route('admin.dashboard')}}">
                    <img src="{{asset('uploads/logoo3.png')}}" alt="" class="w-30 h-30">
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li
                    class="sidebar-item active">
                    <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Хяналтын самбар</span>
                    </a>
                </li>

                <li
                    class="sidebar-item has-sub">
                    <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Тайлан</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item  ">
                            <a href="" class="submenu-link">Сараар</a>

                        </li>

                        <li class="submenu-item  ">
                            <a href="" class="submenu-link">Өдрөөр</a>

                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Хэрэглэгчид</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item  ">
                            <a href="{{ route('role.index') }}" class="submenu-link">Жагсаалт</a>

                        </li>
                        <li class="submenu-item  ">
                            <a href="{{ route('role.create') }}" class="submenu-link">Хэрэглэгч нэмэх</a>

                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item">
                    <a href="{{route('admin.restaurant.index')}}" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Ресторан</span>
                    </a>
                </li>


                <li
                    class="sidebar-item">
                    <a href="{{ route('admin.table.index') }}" class='sidebar-link'>
                        <i class="bi bi-hexagon-fill"></i>
                        <span>Ширээ</span>
                    </a>
                </li>

                <li
                    class="sidebar-item  ">
                    <a href="{{ route('admin.category.index') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Категори</span>
                    </a>
                </li>
                <li
                    class="sidebar-item has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Бүтээгдэхүүн</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item ">
                            <a href="{{ route('admin.product.index2') }}">Жагсаалт</a>
                        </li>
                        <li class="submenu-item  ">
                            <a href="{{ route('admin.product.index') }}" class="submenu-link">Хүснэгтээр</a>

                        </li>
                        <li class="submenu-item  ">
                            <a href="{{ route('admin.product.create') }}" class="submenu-link">Бүтээгдэхүүн нэмэх</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
        <div class="sidebar-footer position-absolute bottom-0 p-2 w-100">
            <div class="d-flex justify-content-between align-items-center p-2" style="border: 1px solid #dee2e6; border-radius: 10px;">

                <h5 class="font-bold m-0" style="color: #495057;">{{ Auth::user()->name }}</h5>


                <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                    @csrf
                    <button
                        type="submit"
                        class="btn btn-danger d-flex align-items-center"
                        style="border-radius: 10px; font-weight: bold; padding: 5px 10px;">
                        Гарах
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

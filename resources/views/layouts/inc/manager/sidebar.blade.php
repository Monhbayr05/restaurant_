<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{route('manager.dashboard')}}">
                        <img src="{{asset('uploads/logoo2.png')}}" alt="Logo" class="img-fluid" style="width: 100px; height: auto;">
                    </a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--system-uicons" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path

                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
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
                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a href="{{route('manager.dashboard')}}" class="sidebar-link">
                        <i class="bi bi-speedometer2"></i> <!-- Dashboard -->
                        <span>Хяналтын самбар</span>
                    </a>
                </li>

                <!-- Reports -->
                <li class="sidebar-item has-sub">
                    <a href="javascript:void(0);" class="sidebar-link">
                        <i class="bi bi-file-earmark-bar-graph"></i> <!-- Reports -->
                        <span>Тайлан</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="">Сараар</a>
                        </li>
                        <li class="submenu-item">
                            <a href="">Өдрөөр</a>
                        </li>
                    </ul>
                </li>

                <!-- Users -->
                <li class="sidebar-item has-sub">
                    <a href="javascript:void(0);" class="sidebar-link">
                        <i class="bi bi-person-lines-fill"></i> <!-- Users -->
                        <span>Хэрэглэгчид</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="{{ route('manager.role.index') }}" class="submenu-link">Жагсаалт</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('manager.role.create') }}" class="submenu-link">Хэрэглэгч нэмэх</a>
                        </li>
                    </ul>
                </li>

                <!-- Tables -->
                <li class="sidebar-item">
                    <a href="{{route('manager.table.index')}}" class="sidebar-link">
                        <i class="bi bi-layout-text-window-reverse"></i> <!-- Tables -->
                        <span>Ширээ</span>
                    </a>
                </li>

                <!-- Orders -->
                <li class="sidebar-item">
                    <a href="{{route('manager.order.index')}}" class="sidebar-link">
                        <i class="bi bi-cart-fill"></i> <!-- Orders -->
                        <span>Захиалга</span>
                    </a>
                </li>

                <!-- Categories -->
                <li class="sidebar-item">
                    <a href="{{route('manager.category.index')}}" class="sidebar-link">
                        <i class="bi bi-tags-fill"></i> <!-- Categories -->
                        <span>Категори</span>
                    </a>
                </li>

                <!-- Products -->
                <li class="sidebar-item">
                    <a href="{{route('manager.product.index')}}" class="sidebar-link">
                        <i class="bi bi-box-seam"></i> <!-- Products -->
                        <span>Бүтээгдэхүүн</span>
                    </a>
                </li>
            </ul>


        </div>
        <div class="sidebar-footer position-absolute bottom-0 p-2 w-100">
            <div class="d-flex justify-content-between align-items-center p-2">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl d-flex align-items-center justify-content-center text-white font-bold"
                        style="background-color: #f59e0b; width: 3rem; height: 3rem; border-radius: 50%;">
                        @if(Auth::user()->profile_image)
                        <img src="{{ Auth::user()->profile_image }}" alt="{{ Auth::user()->name }}" style="border-radius: 50%; width: 100%; height: 100%; object-fit: cover;">
                        @else
                        @if(Auth::user()->role == 'admin')
                        A
                        @elseif(Auth::user()->role == 'manager')
                        M
                        @elseif(Auth::user()->role == 'chef')
                        C
                        @else
                        {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                        @endif
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                    </div>
                </div>



                <form method="POST" action="{{ route('manager.logout') }}" class="m-0">
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
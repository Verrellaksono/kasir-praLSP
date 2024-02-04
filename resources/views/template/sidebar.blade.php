<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            {{-- <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo" />  --}}
            <span class="ms-1 font-weight-bold text-white">Toko Serba Ada</span>
        </a>
    </div>

    <hr class="horizontal light mt-0 mb-2" />

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Barang -->
            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getName() == 'admin.barang'? 'active bg-gradient-primary': '' }}"
                    href="{{ route('admin.barang') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">view_in_ar</i>
                    </div>

                    <span class="nav-link-text ms-1">Barang</span>
                </a>
            </li>

            {{-- Account --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getName() == 'admin.user'? 'active bg-gradient-primary': '' }}"
                    href="{{ route('admin.user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>

                    <span class="nav-link-text ms-1">Account</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn bg-gradient-primary w-100">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>

</aside>

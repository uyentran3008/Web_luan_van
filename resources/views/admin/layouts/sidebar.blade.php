<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0"  target="_blank">
        {{-- <img src="./assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
        <span class="ms-1 font-weight-bold text-white"> Dashboard </span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white  {{request()->routeIs('dashboard') ? 'bg-gradient-primary active' : ''}}"  href="{{route('dashboard')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('roles.*')  ? 'bg-gradient-primary active' : ''}}" href="{{ route('roles.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Role</span>
          </a>
        </li>

        {{-- @can('show-user') --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('users.*')  ? 'bg-gradient-primary active' : ''}}" href="{{ route('users.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">User</span>
          </a>
        </li>
        {{-- @endcan --}}
        
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('products.*')  ? 'bg-gradient-primary active' : ''}}" href="{{ route('products.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Product</span>
          </a>
        </li>
        {{-- @can('show-size') --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('sizes.*')  ? 'bg-gradient-primary active' : ''}}" href="{{ route('sizes.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_kanban</i>
            </div>
            <span class="nav-link-text ms-1">Size Product</span>
          </a>
        </li>
        {{-- @endcan --}}

        {{-- @can('show-category') --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('categories.*')  ? 'bg-gradient-primary active' : ''}}" href="{{ route('categories.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">Category</span>
          </a>
        </li>
        {{-- @endcan --}}

        {{-- @can('show-coupon') --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('coupons.*')? 'bg-gradient-primary active' : '' }} "
              href="{{ route('coupons.index') }}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">sell</i>
              </div>
              <span class="nav-link-text ms-1">Coupon</span>
          </a>
        </li>
        {{-- @endcan --}}

        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'bg-gradient-primary active' : '' }} "
              href="{{ route('admin.orders.index') }}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">shopping_cart</i>
              </div>
              <span class="nav-link-text ms-1">Order</span>
          </a>
      </li>

      {{-- @can('show-supplier') --}}
      <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('admin.suppliers.*') ? 'bg-gradient-primary active' : '' }} "
              href="{{ route('suppliers.index') }}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">inventory_2</i>
              </div>
              <span class="nav-link-text ms-1">Supplier</span>
          </a>
      </li>
      {{-- @endcan --}}
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.suppliers.*') ? 'bg-gradient-primary active' : '' }} "
            href="{{ route('materials.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">food_bank</i>
            </div>
            <span class="nav-link-text ms-1">Material</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.imports.*') ? 'bg-gradient-primary active' : '' }} "
            href="{{ route('imports.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">library_add</i>
            </div>
            <span class="nav-link-text ms-1"> Import Material</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.exports.*') ? 'bg-gradient-primary active' : '' }} "
            href="{{ route('exports.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">library_add_check</i>
            </div>
            <span class="nav-link-text ms-1"> Export Material</span>
        </a>
      </li>
    </ul>
    {{-- </div> --}}

</aside>
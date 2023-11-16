<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">KOPPEE</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="{{ route( 'client.home') }}" class="nav-item nav-link active">Home</a>
                {{-- <a href="" class="nav-item nav-link">About</a> --}}
                <div class="nav-item dropdown">
                    <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">Menu</a>
                    <div class="dropdown-menu text-capitalize">
                        @foreach ($categories as $item)
                        @if ($item->childrens->count() > 0)
                            <div class="nav-item dropdown">
                                <a href="" class="nav-link" data-toggle="dropdown"> <i
                                        class="fa fa-angle-down float-right mt-1"></i> {{ $item->name }}</a>
                                        
                                {{-- <a href="{{ "client.home.index"}}" class="dropdown-item">Cà phê</a> --}}
                                <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">

                                    @foreach ($item->childrens as $childCategory)
                                        <a href="{{ route('client.products.index', ['category_id' => $childCategory->id]) }}"
                                            class="dropdown-item">{{ $childCategory->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ route('client.products.index', ['category_id' => $item->id]) }}"
                                class="dropdown-item">{{ $item->name }}</a> 
                         @endif
                     @endforeach
                    </div>
                </div>
                {{-- <a href="" class="nav-item nav-link">Menu</a> --}}
                <a href="{{ route('client.orders.index') }}" class="nav-item nav-link">Order</a>
                {{-- <a href="" class="nav-item nav-link">Contact</a> --}}
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Account</a>
                    <div class="dropdown-menu text-capitalize">
                
                        {{-- <a href="{{ route('login') }}" class="dropdown-item">Sign in</a>
                        <a href="{{ route('register') }}" class="dropdown-item">Sign up</a> --}}
                        @guest
                        @if (Route::has('login'))
                            {{-- <li class="dropdown-item"> --}}
                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            {{-- </li> --}}
                        @endif

                        @if (Route::has('register'))
                            {{-- <li class="dropdown-item"> --}}
                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                            {{-- </li> --}}
                        @endif
                    @else
                        {{-- <li class="nav-item dropdown"> --}}
                            <a id="navbarDropdown" class="dropdown-item" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                                <a class="dropdown-item" href="{{ route('logout') }}" aria-labelledby="navbarDropdown"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            {{-- </div> --}}
                        {{-- </li> --}}
                    @endguest

                    </div>
                    
                </div>
                
                
                    
                <a href="{{ route('client.carts.index') }}" class=" btn border " style="border: 1px white">
                    <i class="fas fa-shopping-cart text-primary "></i>
                    <span class="badge text-light" id="productCountCart" style="">{{ $countProductInCart }}</span>
                </a>
                
    
            </div>
        </div>
    </nav>
</div>
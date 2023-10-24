<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top ">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical"
                style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">

                    @foreach ($categories as $item)
                        @if ($item->childrens->count() > 0)
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-toggle="dropdown">{{ $item->name }} <i
                                        class="fa fa-angle-down float-right mt-1"></i></a>
                                <div
                                    class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">

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
            </nav>
        </div>
        
            
        
    
<!-- Navbar End -->

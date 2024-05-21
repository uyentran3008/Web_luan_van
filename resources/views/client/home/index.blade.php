@extends('client.layouts.app')
@section ('content')
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h4>
                <h1 class="display-4">Serving Since 2023</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Our Story</h1>
                    {{-- <h5 class="mb-3">Eos kasd eos dolor vero vero, lorem stet diam rebum. Ipsum amet sed vero dolor sea</h5> --}}
                    <p>The Koppee® was established in 2023 and born out of love for Vietnam, its coffee and its communities. Since the beginning, our goal has been to serve and uplift society by enriching human connections and social togetherness.</p>
                    {{-- <a href="" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Learn More</a> --}}
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about.png" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">In the Future</h1>
                    <p>We see a growing Vietnam and an ever evolving The Koppee®. A hub of the community where people can connect and bond over a shared love of delicious, coffee, teas and food. At The Koppee® we stand with you, we stand for you, we stand together as one community.</p>
                    {{-- <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                    <a href="" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Learn More</a> --}}
                </div>
            </div>
        </div>
    </div>
<!-- About End -->
<!-- Service Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Services</h4>
            <h1 class="display-4">Fresh & Organic Beans</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/service-1.jpg" alt="">
                    </div>
                    <div class="col-sm-7">
                        <h4><i class="fa fa-truck service-icon"></i>Fastest Door Delivery</h4>
                        <p class="m-0">
                            Delivery to your door, within Minh Kieu district, with many attractive delivery discount codes</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/service-2.jpg" alt="">
                    </div>
                    <div class="col-sm-7">
                        <h4><i class="fa fa-coffee service-icon"></i>Fresh Coffee Beans</h4>
                        <p class="m-0">Coffee is ground from fresh Vietnamese coffee beans, delicious and rich coffee</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/service-3.jpg" alt="">
                    </div>
                    <div class="col-sm-7">
                        <h4><i class="fa fa-award service-icon"></i>Best Quality Coffee</h4>
                        <p class="m-0">
                            Coffee quality is always guaranteed to be high quality and premium, ensuring 100% pure unadulterated coffee.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/service-4.jpg" alt="">
                    </div>
                    <div class="col-sm-7">
                        <h4><i class="fa fa-table service-icon"></i>Diverse menu of drinks</h4>
                        <p class="m-0">The menu of drinks is diverse, updated with new dishes continuously and seasonally</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->
<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">New Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ $product->images->count() > 0 ? asset('upload/' . $product->images->first()->url) : 'upload/default.png' }}" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    
                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                    
                    <div class="d-flex justify-content-center">
                        
                        <h6>{{ number_format($product->sizes->first()->pivot->price) }} VNĐ</h6><h6 class="text-muted ml-2"></h6>
                        
                    </div>
                    

                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{ route('client.products.show', $product->id) }}" class="btn btn-sm text-dark p-1"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    {{-- <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div>
    {{ $products->links() }}
</div>
<!-- Products End -->


@endsection

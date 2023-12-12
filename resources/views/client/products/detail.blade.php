@extends('client.layouts.app')
@section('title', 'Product detail')
@section('content')
    <div class="d-inline-flex" style="margin-left: 40px">
        <div class="row">
            <p class="m-0"><a href="{{ route('client.home') }}">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Product Detail</p>
        </div>
    </div>
    @if (session('message'))
        <h2 class="" style="text-align: center; width:100%; color:red"> {{ session('message') }}</h2>
    @endif

     <!-- Shop Detail Start -->
     <div class="container-fluid py-5">
        <form action="{{ route('client.carts.add') }}" method="POST" class="row ">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="row px-xl-5">
                <div class="col-lg-5 pb-5">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border">
                            <div class="carousel-item active">
                                <img class="w-100 h-100"
                                    src="{{ $product->images->count() > 0 ? asset('upload/' . $product->images->first()->url) : 'upload/default.png' }}"
                                    alt="Image">
                            </div>

                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-7 pb-5">
                    <h1 class="font-weight-semi-bold">{{ $product->name }}</h1>
                    {{-- <div class="d-flex mb-3">

                    </div> --}}
                    {{-- <h3 class="font-weight-semi-bold mb-4">${{ $product->price }}</h3> --}}


                    <div >
                        <p class="text-dark font-weight-medium mb-0 mr-3"> Choose Size:</p>
                        <form>
                            @foreach ($product->sizes as $size)
                                <div class="form-check " style="font-size: x-large; padding: 10px">
                                    {{-- <input type="radio" class="custom-control-input" id="color-1" name="color">
                                    <label class="custom-control-label" for="color-1">{{ $size->name }}</label> --}}
                                    {{-- <input type="button" class="btn btn-light" style="border: solid; margin: 10px; padding: 10px"id="{{ $size->id }}" name="size_id"  value="{{ $size->name }} "> --}}
                                    
                                    <input type="radio" class="form-check-input" name="size_id" value="{{ $size->id }}" id="size{{ $size->size }}">
                                    <label for="size{{ $size->size }}" class="form-check-label">{{ $size->name }} :  {{ $size->pivot->price }} VNĐ</label>

                                    
                                    {{-- <div class="  " style="margin-left: 20px">Price: {{ $size->pivot->price }} VNĐ</div> --}}
                                </div>
                                
                            @endforeach
                            
                        </form>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        {{-- <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" style="background-color: aliceblue" class="form-control text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div> --}}
                        <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                    {{-- <div class="d-flex pt-2">
                        <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </form>
        <hr>
        <div class="row px-xl-5">
            
            <div>
                <h3 class="mb-4">Product Description </h3>
                <div>{!!  $product->description !!}</div>
            </div>  
        </div>
        <hr>
        <div class="row px-xl-5">
            <h3 class="mb-4">New Product</h3>
            <div class="row px-xl-2 pb-3">
                @foreach($products as $product)
                <div class="col-lg-2 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ $product->images->count() > 0 ? asset('upload/' . $product->images->first()->url) : 'upload/default.png' }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            
                            <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                            
                            <div class="d-flex justify-content-center">
                                
                                <h6>{{ $product->sizes->first()->pivot->price }} VNĐ</h6><h6 class="text-muted ml-2"></h6>
                                
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

    </div>


@endsection
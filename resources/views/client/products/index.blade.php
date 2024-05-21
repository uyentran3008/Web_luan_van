@extends("client.layouts.app")
@section('title', 'Product')
@section('content')
    <div class="d-inline-flex" style="margin-left: 40px">
        <div class="row">
            <p class="m-0"><a href="{{ route('client.home') }}">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
    @include('client.layouts.sidebar')
    <!-- Shop Product Start -->
    <div class="col-lg-9 ">
        <div class="row pb-3">

            @foreach ($products as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div
                            class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100"
                                src="{{ $item->images->count() > 0 ? asset('upload/' . $item->images->first()->url) : 'upload/default.png' }}"
                                alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $item->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>{{  number_format($item->sizes->first()->pivot->price) }} VNĐ</h6>
                                {{-- <h6 class="item-muted ml-2"><del>${{ $item->price }}</del></h6> --}}
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{route('client.products.show', $item->id) }}"
                                class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="col-12 pb-1">
                {{ $products->links() }}

            </div>
        </div>
    </div>
    <!-- Shop Product End -->
</div>
</div>
@endsection

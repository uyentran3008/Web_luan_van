@extends('client.layouts.app')
@section('title', 'Cart')
@section('content')
<div class="d-inline-flex" style="margin-left: 40px">
    <div class="row">
        <p class="m-0"><a href="{{ route('client.home') }}">Home</a></p>
        <p class="m-0 px-2">/</p>
        <p class="m-0">Order</p>
    </div>
</div>
    <div class="container-fluid pt-5">
        <form class="row px-xl-5" method="POST" action="{{ route('client.checkout.proccess') }}">
            @csrf
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control" value="{{ old('customer_name') }}" name="customer_name"
                                type="text" placeholder="John">
                            @error('customer_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror ()

                        </div>

                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" name="customer_email" value="{{ old('customer_email') }}"
                                type="text" placeholder="example@email.com">
                            @error('customer_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror ()
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" name="customer_phone" value="{{ old('customer_phone') }}"
                                type="text" placeholder="+123 456 789">
                            @error('customer_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror ()
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address </label>
                            <input class="form-control" name="customer_address" value="{{ old('customer_address') }}"
                                type="text" placeholder="123 Street">
                            @error('customer_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror ()
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Note </label>
                            <input class="form-control" value="{{ old('note') }}" name="note" type="text"
                                placeholder="123 Street">
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror ()
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0 ">
                        <h4 class="font-weight-semi-bold m-0 text-light">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        @foreach ($cart->products as $item)
                            <div class="d-flex justify-content-between">
                                <p> {{ $item->product_quantity }} x {{ $item->product->name }}</p>
                                <p
                                    style="
                                        {{ $item->product->sale ? 'text-decoration: line-through' : '' }};
                                                                ">
                                    {{number_format(  $item->product->sizes()->where('name', $item->size->name)->first()->pivot->price * $item->product_quantity)}} VNĐ
                                </p>

                                @if ($item->product->sale)
                                    <p
                                        style="
                                                                                                                                                                                                                                                                                                                                                                                                                            ">
                                        {{number_format( $item->product_quantity * ($item->product->sizes()->where('name', $item->size->name)->first()->pivot->price - ($item->product->sizes()->where('name', $item->size->name)->first()->pivot->price  * 0.01 * $item->product->sale)) )}} VNĐ
                                    </p>
                                @endif

                            </div>
                        @endforeach
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium total-price" data-price="{{ $cart->total_price }}">
                                {{number_format( $cart->total_price) }} VNĐ</h6>

                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium shipping" data-price="20000">{{  number_format(20000 )}}VNĐ</h6>
                            <input type="hidden" value="20000" name="ship">

                        </div>
                        @if (session('discount_amount_price'))
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Coupon </h6>
                                <h6 class="font-weight-medium coupon-div"
                                    data-price="{{ session('discount_amount_price') }}">
                                    {{ session('discount_amount_price') }} VNĐ</h6>
                            </div>
                        @endif

                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold total-price-all"></h5>
                            <input type="hidden" id="total" value="" name="total">
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0 text-light">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="radio" class="form-check-input"  value="monney" name="payment">
                                <label class="form-check-label">Money</label>
                            </div>
                            {{-- <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input"  value="paypal" name="payment">
                                <label class="custom-control-label">Paypal</label>
                            </div> --}}
                            <div class="form-check">
                                <input type="radio" class="form-check-input"  value="VNPay" name="payment">
                                <label class="form-check-label">VNPay</label>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        {{-- <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3"><a href="{{ route('client.checkout.payment') }}">VNPAY</a></button> --}}
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place
                            Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {


            getTotalValue()

            function getTotalValue() {
                let total = $('.total-price').data('price')
                let couponPrice = $('.coupon-div')?.data('price') ?? 0;
                let shiping = $('.shipping').data('price')
                $('.total-price-all').text(`${total + shiping  - couponPrice}VNĐ`)
                $('#total').val(total + shiping  - couponPrice )
            }

        });
    </script>

@endsection

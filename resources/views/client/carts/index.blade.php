@extends('client.layouts.app')
@section('title', 'Cart')
@section('content')
<div class="d-inline-flex" style="margin-left: 40px">
    <div class="row">
        <p class="m-0"><a href="{{ route('client.home') }}">Home</a></p>
        <p class="m-0 px-2">/</p>
        <p class="m-0">Cart Detail</p>
    </div>
</div>
      <div class="row px-xl-5" style="padding-top: 40px">
          <div class="col-lg-8 table-responsive mb-5">
              <table class="table table-bordered text-center mb-0">
                  <thead class="bg-secondary text-light">
                      <tr>
                          <th>Products</th>
                          <th>Price</th>
                          <th>Size</th>
                          <th>Sale</th>
                          <th>Quantity</th>
                          <th>Total</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody class="align-middle">
                    
                      @foreach ($carts->products as $item)
                        {{-- @foreach($item->sizes as $size) --}}
                        <tr id="row-{{ $item->id }}">
                            <td class="align-middle"><img src="{{ $item->product->image_path }}" alt=""
                                      style="width: 50px;">
                                  {{ $item->product->name }}
                            </td>
                           
                               <td class="align-middle">
                                  <p
                                      style="{{ $item->product->sale ? 'text-decoration: line-through' : ''}}"                                                                                                                                                                                                                                             ">
                                      {{-- ${{ $item->price }} --}}
                                      {{number_format( $item->product->sizes()->where('name', $item->size->name)->first()->pivot->price) }} VNĐ
                                  </p>

                                  @if ($item->product->sale)
                                      <p
                                          style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                          {{number_format( $item->product->sizes()->where('name', $item->size->name)->first()->pivot->price - ($item->product->sizes()->where('name', $item->size->name)->first()->pivot->price  * 0.01 * $item->product->sale)) }} VNĐ
                                      </p>
                                  @endif
                                
                              </td> 
                              <td class="align-middle">
                                {{-- @foreach($item->sizes as $size => $i ) --}}
                                {{$item->size->name}}
                                {{-- @endforeach --}}
                            </td> 
                              
                              <td class="align-middle">{{ $item->product->sale }}</td>
                              <td class="align-middle">
                                  <div class="input-group quantity mx-auto" style="width: 100px;">
                                      <div class="input-group-btn">
                                          <button class="btn btn-sm btn-primary btn-minus btn-update-quantity"
                                              data-action="{{ route('client.carts.update_product_quantity', $item->id) }}"
                                              data-id="{{ $item->id }}">
                                              <i class="fa fa-minus"></i>
                                              
                                          </button>
                                      </div>
                                      <input type="number" style="background-color: aliceblue" class="form-control form-control-sm  text-center p-0"
                                          id="productQuantityInput-{{ $item->id }}" min="1" 
                                          value="{{ $item->product_quantity }}" >
                                      <div class="input-group-btn">
                                          <button class="btn btn-sm btn-primary btn-plus btn-update-quantity"
                                              data-action=" {{ route('client.carts.update_product_quantity', $item->id) }}"
                                              data-id="{{ $item->id }}">
                                              <i class="fa fa-plus"></i>
                                             
                                          </button>
                                      </div>
                                  </div>
                              </td>
                              <td class="align-middle">
                                  <span
                                      id="cartProductPrice{{ $item->id }}">
                                {{number_format( $item->product->sale ? $item->product->sizes()->where('name', $item->size->name)->first()->pivot->price - ($item->product->sizes()->where('name', $item->size->name)->first()->pivot->price  * 0.01 * $item->product->sale) * $item->product_quantity 
                                : $item->product->sizes()->where('name', $item->size->name)->first()->pivot->price * $item->product_quantity) }} VNĐ</span>

                              </td>
                              <td class="align-middle">
                                  <button class="btn btn-sm btn-primary btn-remove-product"
                                      data-action="{{ route('client.carts.remove_product', $item->id) }}"><i
                                          class="fa fa-times"></i></button>
                              </td>
                          </tr>
                        {{-- @endforeach --}}
                          
                      @endforeach

                  </tbody>
              </table>
          </div>
          <div class="col-lg-4">
              <form class="mb-5" method="POST" action="{{  route('client.carts.apply_coupon')}}">

                  @csrf
                  <div class="input-group">
                      <input type="text" class="form-control p-4" value="{{ Session::get('coupon_code') }}"
                          name="coupon_code" placeholder="Coupon code">
                        
                      <div class="input-group-append">
                          <button class="btn btn-primary">Apply Coupon</button>
                      </div>
                  </div>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#discountCodesModal" style="padding: 10px; margin: 10px">
                    View coupon list
                </button>
                <div class="modal fade" id="discountCodesModal" tabindex="-1" role="dialog" aria-labelledby="discountCodesModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="discountCodesModalLabel">Coupon List <sup>(*)</sup>
                                    
                                </h5> 
                                                              
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                
                            </div>
                            <div>
                                <i>                                   
                                    (*)See the list of discount codes and enter the discount code name into the coupon code 
                                </i>
                            </div> 
                            
                            
                            <div class="modal-body">
                                <!-- Hiển thị danh sách mã giảm giá -->
                                <ul>
                                    @foreach($coupons as $coupon)
                                        <li class="discount-code" data-code="{{ $coupon->name }}">
                                            {{ $coupon->name }} - {{number_format( $coupon->value )}} VNĐ
                                            
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
              </form>
              <div class="card border-secondary mb-5">
                  <div class="card-header bg-secondary border-0">
                      <h4 class="font-weight-semi-bold m-0 text-light">Cart Summary</h4>
                  </div>
                  <div class="card-body">
                      <div class="d-flex justify-content-between mb-3 pt-1">
                          <h6 class="font-weight-medium">Subtotal</h6>
                          <h6 class="font-weight-medium total-price" data-price="{{ $carts->total_price }}">
                              {{number_format( $carts->total_price )}} VNĐ</h6>
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
                      </div>
                      <a href="{{  route('client.checkout.index')  }}" class="btn btn-block btn-primary my-3 py-3">Proceed
                          To Checkout</a>
                  </div>
              </div>
          </div>
      </div>
  @endsection
@section('scripts')
  <script>   
    //   try{
       
        $(function() {
            getTotalValue()

              function getTotalValue() {
                  let total = $('.total-price').data('price')
                  let couponPrice = $('.coupon-div')?.data('price') ?? 0;
                  $('.total-price-all').text(`${total - couponPrice} VNĐ `)

              }

          $(document).on('click', '.btn-remove-product', function(e) {
              let url = $(this).data('action')
              confirmDelete()
                  .then(function() {
                      $.post(url, res => {
                          let cart = res.cart;
                          let cartProductId = res.product_cart_id;
                          $('#productCountCart').text(cart.product_count)
                          $('.total-price').text(`${cart.total_price}`).data('price', cart
                              .product_count)
                          $(`#row-${cartProductId}`).remove();
                      })
                  })
                  .catch(function() {

                  })
          })

            const TIME_TO_UPDATE = 1000;

            $(document).on('click', '.btn-update-quantity', _.debounce(function(e) {
                let url = $(this).data('action')
                let id = $(this).data('id')
                let data = {
                    product_quantity : $(`#productQuantityInput-${id}`).val()
                }
                $.post(url, data, res => {
                    let cartProductId = res.product_cart_id;
                    let cart = res.cart;
                    $('#productCountCart').text(cart.product_count)
                    if (res.remove_product) {
                        $(`#row-${cartProductId}`).remove();
                    } 
                    else {
                        $(`#cartProductPrice${cartProductId}`).html(
                            `${res.cart_product_price} VNĐ`);
                    }
                    cartProductPrice
                    $('.total-price').text(`${cart.total_price}`)
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                })
            }, TIME_TO_UPDATE))

      });


  </script>
@endsection

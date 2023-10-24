@extends('client.layouts.app')
@section('title', 'Cart')
  @section('content')
      <div class="row px-xl-5">
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
                    
                      @foreach ($cart->products as $item)
                        {{-- @foreach($item->sizes as $size) --}}
                        <tr id="row-{{ $item->id }}">
                            <td class="align-middle"><img src="{{ $item->image_path }}" alt=""
                                      style="width: 50px;">
                                  {{ $item->name }}
                            </td>
                               <td class="align-middle">
                                  <p
                                      {{-- style="{{ $item->sale ? 'text-decoration: line-through' : '' }};                                                                                                                                                                                                                                                 "> --}}
                                      {{-- ${{ $item->price }} --}}
                                      {{ $item->price }} VNĐ
                                  </p>

                                  {{-- @if ($item->sale)
                                      <p
                                          style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                          ${{ $item->sale_price }}
                                      </p>
                                  @endif --}}
                              </td> 
                              <td class="align-middle">
                                {{-- @foreach($carts as $size) --}}
                                {{-- {{ $item->size->id}} --}}
                                {{-- @endforeach --}}
                            </td> 
                              
                              <td class="align-middle">{{ $item->sale }}</td>
                              <td class="align-middle">
                                  <div class="input-group quantity mx-auto" style="width: 100px;">
                                      <div class="input-group-btn">
                                          <button class="btn btn-sm btn-primary btn-minus btn-update-quantity"
                                              data-action=""
                                              data-id="{{ $item->id }}">
                                              <i class="fa fa-minus"></i>
                                              {{-- {{ route('client.carts.update_product_quantity', $item->id) }} --}}
                                          </button>
                                      </div>
                                      <input type="number" style="background-color: aliceblue" class="form-control form-control-sm  text-center p-0"
                                          id="productQuantityInput-{{ $item->id }}" min="1"
                                          value="{{ $item->pivot->product_quantity }}" >
                                      <div class="input-group-btn">
                                          <button class="btn btn-sm btn-primary btn-plus btn-update-quantity"
                                              data-action=""
                                              data-id="{{ $item->id }}">
                                              <i class="fa fa-plus"></i>
                                              {{-- {{ route('client.carts.update_product_quantity', $item->id) }} --}}
                                          </button>
                                      </div>
                                  </div>
                              </td>
                              {{-- <td class="align-middle">
                                  <span
                                      id="cartProductPrice{{ $item->id }}">${{ $item->product->sale ? $item->product->sale_price * $item->product_quantity : $item->product->price * $item->product_quantity }}</span>

                              </td> --}}
                              {{-- <td class="align-middle">
                                  <button class="btn btn-sm btn-primary btn-remove-product"
                                      data-action="{{ route('client.carts.remove_product', $item->id) }}"><i
                                          class="fa fa-times"></i></button>
                              </td> --}}
                          </tr>
                        {{-- @endforeach --}}
                          
                      @endforeach

                  </tbody>
              </table>
          </div>
          <div class="col-lg-4">
              <form class="mb-5" method="POST">
                  @csrf
                  <div class="input-group">
                      <input type="text" class="form-control p-4" value="{{ Session::get('coupon_code') }}"
                          name="coupon_code" placeholder="Coupon Code">
                      <div class="input-group-append">
                          <button class="btn btn-primary">Apply Coupon</button>
                      </div>
                  </div>
              </form>
              {{-- <div class="card border-secondary mb-5">
                  <div class="card-header bg-secondary border-0">
                      <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                  </div>
                  <div class="card-body">
                      <div class="d-flex justify-content-between mb-3 pt-1">
                          <h6 class="font-weight-medium">Subtotal</h6>
                          <h6 class="font-weight-medium total-price" data-price="{{ $cart->total_price }}">
                              ${{ $cart->total_price }}</h6>
                      </div>
                      @if (session('discount_amount_price'))
                          <div class="d-flex justify-content-between">
                              <h6 class="font-weight-medium">Coupon </h6>
                              <h6 class="font-weight-medium coupon-div"
                                  data-price="{{ session('discount_amount_price') }}">
                                  ${{ session('discount_amount_price') }}</h6>
                          </div>
                      @endif

                  </div>
                  <div class="card-footer border-secondary bg-transparent">
                      <div class="d-flex justify-content-between mt-2">
                          <h5 class="font-weight-bold">Total</h5>
                          <h5 class="font-weight-bold total-price-all"></h5>
                      </div>
                      <a class="btn btn-block btn-primary my-3 py-3">Proceed
                          To Checkout</a>
                  </div>
              </div> --}}
          </div>
      </div>
  @endsection

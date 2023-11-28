@extends('admin.layouts.app')
@section('title','Product Order Detail')
@section('content')
<div class="card">

    @if (session('message'))
        <h1 class="text-primary">{{ session('message') }}</h1>
    @endif
{{-- <div>
    <button style="width: 50px; " class="btn-primary" onclick="printInvoice()">Print</button>
</div> --}}

    <h1>
        Order Detail - Order #{{ $order->id }}
    </h1>
    <p>Order Date: {{ $order->created_at }}</p>
    <div>
        <table class="table table-hover">
            <tr class="table-primary">
                
                <th>Product</th>
                <th>Size</th>
                <th>Quantity</th>

                {{-- <th>Action</th> --}}
            </tr>

            @foreach ($order->productOrders as $productOrder)
                <tr>
                    <td>{{ $productOrder->product->name }}</td>
                    <td>{{ $productOrder->size->name }}</td>

                    <td>{{  $productOrder->product_quantity }}</td>
                    

                    
                </tr>
            @endforeach
            <tr class="table-dark">
                
                <th>Total: {{ $order->total }} VNĐ</th>
                <th></th>
                <th></th>

                {{-- <th>Action</th> --}}
            </tr>
            {{-- <tr>
                

            </tr> --}}
        </table>
       
    </div>

</div>
    
@endsection
@section('scripts')

@endsection
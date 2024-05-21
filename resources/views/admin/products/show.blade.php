@extends('admin.layouts.app')
@section('title','Products')
@section('content')
<div class="card ">
    <h1>Show Detail Product</h1>
    
    <div>
        <div class="row">
            <div>
                <h3>Image</h3>
                <div class="col-5">
                    <img src="{{ $product->images ? asset('upload/' . $product->images->first()->url) : 'upload/default.png' }}" id="show-image" alt="">
                </div>
            </div>

            <div class="col-5">
                <h5>Name: </h5>
                <p>{{ $product->name }}</p>
            </div>

            <div class="">
                <h5>Size and Price</h5>
                @foreach($product->sizes as $size)
                    <p>Size {{ $size->name }} : {{number_format( $size->pivot->price )}} VNĐ</p>
                    
            
                @endforeach
            </div>
            
            <div>
                <h5>Sale: {{ $product->sale }}</h5>

            </div>
            <div class="form-group">
                <h5>Description:</h5>
                <div class="row w-100 h-100">
                    {!! $product->description  !!}
                </div>
            </div>

            <div>
                <h5>Category:</h5>
                @foreach($product->categories as $item)
                    <p>{{ $item->name }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
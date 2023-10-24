@extends('admin.layouts.app')
@section('title','Show Product List')
@section('content')
<div class="card ">
    <h1>Product List</h1>
    <div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
    </div>
    <div>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                {{-- <th>Price</th> --}}
                <th>Sale</th>
                <th>Action</th>
            </tr>
            @foreach ($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><img src="{{ $item->images->count() > 0 ? asset('upload/' .$item->images->first()->url) : 'upload/default.png' }}" width="100px" height="100px" alt=""></td>
                <td>{{ $item->name }}</td>
                <td>{!! $item->description !!}</td>
                {{-- <td>{{ $item->price }}</td> --}}
                <td>{{ $item->sale }}</td>
                <td>
                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('products.show', $item->id) }}" class="btn btn-primary">Show</a>
                    <form action="{{ route('products.destroy', $item->id) }}" id="form-delete{{ $item->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class=" btn btn-delete btn-danger" type="submit" data-id="{{ $item->id }}">Delete</button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </table>
        {{  $products->links()}}
    </div>
    
</div>
@endsection
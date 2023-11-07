@extends('admin.layouts.app')
@section('title', 'Create Suppliers')
@section('content')
<div class="card">
    <h1>Create Supplier</h1>

    <div>
        <form action="{{ route('suppliers.store') }}" method="post">
            @csrf

            <div class="input-group input-group-static mb-4">
                <label>Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control">
                    

                @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="input-group input-group-static mb-4">
                <label>Phone</label>
                <input type="number" value="{{ old('phone') }}" name="phone" class="form-control">

                @error('phone')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Address</label>
                <input type="text" value="{{ old('address') }}" name="address" class="form-control">

                @error('address')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Description</label>
                <input type="text" value="{{ old('description') }}" name="description" class="form-control">

                @error('description')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
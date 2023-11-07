@extends('admin.layouts.app')
@section('title','Create Material')
@section('content')
<div class="card">
    <h1>Create Material</h1>

    <div>
        <form action="{{ route('materials.store') }}" method="post">
            @csrf

            <div class="input-group input-group-static mb-4">
                <label>Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                    >

                @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            

            <div class="input-group input-group-static mb-4">
                <label name="group" class="ms-0">Unit of Measure</label>
                <select name="unit_of_measure" class="form-control">
                    <option> Select Type </option>
                    <option value="kg"> kg </option>
                    <option value="bottle"> bottle/can </option>
                    <option value="box"> box </option>
                    <option value="bag"> bag </option>
                </select>
            </div>
            @error('type')
                <span class="text-danger"> {{ $message }}</span>
            @enderror

            <div class="input-group input-group-static mb-4">
                <label>Price</label>
                <input type="number" value="{{ old('price') }}" name="price" class="form-control">

                @error('price')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Inventory Number</label>
                <input type="number" value="{{ old('inventory_number') }}" name="inventory_number" class="form-control">

                @error('inventory_number')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
@extends('admin.layouts.app')
@section('title','Edit Material')
@section('content')
<div class="card">
    <h1>Edit Material</h1>

    <div>
        <form action="{{ route('materials.update', $material->id) }}" method="post">
            @csrf
            @method('put')
            <div class="input-group input-group-static mb-4">
                <label>Name</label>
                <input type="text" value="{{ old('name') ?? $material->name}}" name="name" class="form-control"
                    >

                @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            

            <div class="input-group input-group-static mb-4">
                <label name="group" class="ms-0">Unit of Measure</label>
                <select name="unit_of_measure" class="form-control" id='unit_of_measure'>
                    {{-- <option> Select Type </option> --}}
                    <option value="kg" {{ old('unit_of_measure') == 'kg' ? 'selected' : '' }}> kg </option>
                    <option value="bottle" {{ old('unit_of_measure') == 'bottle' ? 'selected' : '' }}> bottle/can </option>
                    <option value="box" {{ old('unit_of_measure') == 'box' ? 'selected' : '' }}> box </option>
                    <option value="bag" {{ old('unit_of_measure') == 'bag' ? 'selected' : '' }}> bag </option>
                </select>
            </div>
            @error('type')
                <span class="text-danger"> {{ $message }}</span>
            @enderror

            <div class="input-group input-group-static mb-4">
                <label>Price</label>
                <input type="number" value="{{ old('price') ?? $material->price }}" name="price" class="form-control">

                @error('price')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Quantity entered</label>
                <input type="number" value="{{ $material->import->sum('quantity_entered')}}" name="quantity_entered" class="form-control" readonly>

                @error('inventory_number')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Export quantity </label>
                <input type="number" value="{{ $material->export->sum('export_quantity')}}" name="export_quantity" class="form-control"  readonly>

                @error('inventory_number')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Inventory Number</label>
                <input type="number" value="{{ $material->import->sum('quantity_entered') -  $material->export->sum('export_quantity')}}" name="inventory_number" class="form-control">

                @error('inventory_number')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
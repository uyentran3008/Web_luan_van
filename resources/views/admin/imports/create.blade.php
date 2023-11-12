@extends('admin.layouts.app')
@section('title','Create Import Material')
@section('content')
<div class="card">
    <h1>Create Import Material</h1>

    <div>
        <form action="{{ route('imports.store') }}" method="post" id="createForm" enctype="multipart/form-data">
            @csrf

            <div class="input-group input-group-static mb-4">
                <label>Importer</label>
                <input type="text"  value="{{ old('importer') }}" name="importer" class="form-control">
                @error('importer')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label name="group" class="ms-0">Select Supplier</label>
                <select name="supplier" class="form-control" multiple >
                    
                    @foreach ($suppliers as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                @error('supplier')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>


            <div class="input-group input-group-static mb-4">
                <label name="group" class="ms-0">Select Material</label>
                <select name="material" class="form-control" multiple >
                    
                    @foreach ($materials as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                @error('material_ids')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            
            

            <div class="input-group input-group-static mb-4">
                <label>Quantity Entered</label>
                <input type="number" value="0" value="{{ old('quantity_entered') }}" name="quantity_entered" class="form-control">
                @error('quantity_entered')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>



            <div class="input-group input-group-static mb-4">
                <label>Import Date</label>
                <input type="date"  value="{{ old('import_date') }}" name="import_date" class="form-control">
                @error('import_date')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            

            
           
    </div>
    {{-- <div class="input-group input-group-static mb-4">
        <label name="group" class="ms-0">Category</label>
        <select name="category_ids[]" class="form-control" multiple>
            @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>

        @error('category_ids')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div> --}}

    <button type="submit" class="btn btn-submit btn-primary">Submit</button>
    </form>
</div>
</div>
@endsection
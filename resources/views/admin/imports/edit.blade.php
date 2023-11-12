@extends('admin.layouts.app')
@section('title','Edit Import Material')
@section('content')
<div class="card">
    <h1>Edit Import Material</h1>

    <div>
        <form action="{{ route('imports.update',$import->id) }}" method="post" id="createForm" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="input-group input-group-static mb-4">
                <label>Importer</label>
                <input type="text"  value="{{ old('importer') ?? $import->importer}}" name="importer" class="form-control">
                @error('importer')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label name="group" class="ms-0">Select Supplier</label>
                <select name="supplier" class="form-control" multiple >
                    
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"{{ $import->supplier_id == $supplier->id ? 'selected' : '' }} >{{  $supplier->name }}</option>
                        
                    @endforeach
                </select>

                @error('supplier')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>


            <div class="input-group input-group-static mb-4">
                <label name="group" class="ms-0">Select Material</label>
                <select name="material" class="form-control" multiple >
                    
                    @foreach ($materials as $material)
                        <option value="{{ $material->id }}"{{ $import->material_id == $material->id ? 'selected' : '' }}>{{ $material->name }}</option>
                    @endforeach
                </select>

                @error('material')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            
            

            <div class="input-group input-group-static mb-4">
                <label>Quantity Entered</label>
                <input type="number"  value="{{ old('quantity_entered') ?? $import->quantity_entered}}" name="quantity_entered" class="form-control">
                @error('quantity_entered')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>



            <div class="input-group input-group-static mb-4">
                <label>Import Date</label>
                <input type="date"  value="{{ old('import_date') ?? $import->import_date }}" name="import_date" class="form-control">
                @error('import_date')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            

            
           
    </div>
    

    <button type="submit" class="btn btn-submit btn-primary">Submit</button>
    </form>
</div>
</div>
@endsection
    

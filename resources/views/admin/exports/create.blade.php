@extends('admin.layouts.app')
@section('title','Create Export Material')
@section('content')
<div class="card">
    <h1>Create Export Material</h1>

    <div>
        <form action="{{ route('exports.store') }}" method="post" id="createForm" enctype="multipart/form-data">
            @csrf

            <div class="input-group input-group-static mb-4">
                <label>Exporter</label>
                <input type="text"  value="{{ old('exporter') }}" name="exporter" class="form-control">
                @error('exporter')
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

                @error('material')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            
            

            <div class="input-group input-group-static mb-4">
                <label>Export Quantity</label>
                <input type="number" value="0" value="{{ old('export_quantity') }}" name="export_quantity" class="form-control">
                @error('export_quantity')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>



            <div class="input-group input-group-static mb-4">
                <label>Export Date</label>
                <input type="date"  value="{{ old('export_date') }}" name="export_date" class="form-control">
                @error('export_date')
                    <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
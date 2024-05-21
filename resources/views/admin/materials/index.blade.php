@extends('admin.layouts.app')
@section('title','Materials')
@section('content')
<div class="card">

    @if (session('message'))
        <h1 class="text-primary">{{ session('message') }}</h1>
    @endif


    <h1>
        Material List
    </h1>
    <div>
        <a href="{{ route('materials.create') }}" class="btn btn-primary">Create</a>

    </div>
    <div>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Inventory Number</th>
                <th>Quantity Entered</th>
                <th>Export Quantity</th>
                <th>Action</th>
            </tr>

            @foreach ($materials as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>

                    <td>{{ $item->unit_of_measure }}</td>
                    <td>{{ number_format($item->price) }} VNĐ</td>
                    
                    <td>{{  $item->import ? $item->import->sum('quantity_entered') : 0  }}</td>
                    <td>{{ $item->export ? $item->export->sum('export_quantity') : 0 }}</td>
                    <td>{{ $item->inventory_number }}</td>
                    <td>
                        @can('update-material')
                        <a href="{{ route('materials.edit',$item->id) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        @can('delete-material')
                        <form action="{{ route('materials.destroy', $item->id) }}" id="form-delete{{ $item->id }}"
                            method="post">
                            @csrf
                            @method('delete')

                        </form>

                        <button class="btn btn-delete btn-danger" data-id={{ $item->id }}>Delete</button>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $materials->links() }}
    </div>

</div>
@endsection('')
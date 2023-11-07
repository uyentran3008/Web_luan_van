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

                <th>Action</th>
            </tr>

            @foreach ($materials as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>

                    <td>{{ $item->unit_of_measure }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->inventory_number }}</td>

                    <td>
                        <a href="{{ route('materials.edit',$item->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('materials.destroy', $item->id) }}" id="form-delete{{ $item->id }}"
                            method="post">
                            @csrf
                            @method('delete')

                        </form>

                        <button class="btn btn-delete btn-danger" data-id={{ $item->id }}>Delete</button>

                    </td>
                </tr>
            @endforeach
        </table>
        {{ $materials->links() }}
    </div>

</div>
@endsection('')
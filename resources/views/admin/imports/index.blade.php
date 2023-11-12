@extends('admin.layouts.app')
@section('title', 'Import Material')
@section('content')
<div class="card">

    @if (session('message'))
        <h3 class="text-danger">{{ session('message') }}</h3>
    @endif


    <h1>
        Import Material List
    </h1>
    <div>
        <a href="{{ route('imports.create') }}" class="btn btn-primary">Create</a>

    </div>
    <div>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Supplier</th>
                <th>Material</th>
                <th>Quantity Entered</th>
                <th>Import Date</th>
                <th>Importer</th>
                <th>Action</th>
            </tr>

            @foreach ($imports as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->supplier->name }}</td>

                    <td>{{ $item->material->name }}</td>
                    <td>{{ $item->quantity_entered }}</td>
                    <td>{{ $item->import_date }}</td>
                    <td>{{ $item->importer }}</td>
                    <td>
                        <a href="{{ route('imports.edit',$item->id) }} " class="btn btn-warning">Edit</a>

                        <form action="{{ route('imports.destroy', $item->id) }}" id="form-delete{{ $item->id }}"
                            method="post">
                            @csrf
                            @method('delete')

                        </form>

                        <button class="btn btn-delete btn-danger" data-id={{ $item->id }}>Delete</button>

                    </td>
                </tr>
            @endforeach
        </table>
        {{ $imports->links() }}
    </div>

</div>
@endsection
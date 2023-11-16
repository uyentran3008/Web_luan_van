@extends('admin.layouts.app')
@section('title','Export Material List')
@section('content')
<div class="card">

    @if (session('message'))
        <h3 class="text-danger">{{ session('message') }}</h3>
    @endif


    <h1>
        Export Material List
    </h1>
    <div>
        <a href="{{ route('exports.create') }}" class="btn btn-primary">Create</a>

    </div>
    <div>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Material</th>
                <th>Export Quantity</th>
                <th>Export Date</th>
                <th>Exporter</th>
                <th>Action</th>
            </tr>

            @foreach ($exports as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->material->name }}</td>

                    <td>{{ $item->export_quantity }}</td>
                    <td>{{ $item->export_date }}</td>
                    <td>{{ $item->exporter }}</td>

                    <td>
                        @can('update-export')
                        <a href="{{ route('exports.edit', $item->id) }} " class="btn btn-warning">Edit</a>
                        @endcan
                        @can('delete-export')
                        <form action="{{ route('exports.destroy', $item->id) }}" id="form-delete{{ $item->id }}"
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
        {{ $exports->links() }}
    </div>

</div>
@endsection
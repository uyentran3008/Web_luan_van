@extends('admin.layouts.app')
@section('title', 'Suppliers')
@section('content')
    <div class="card">

        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif


        <h1>
            Supplier List
        </h1>
        <div>
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Create</a>

        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Description</th>

                    <th>Action</th>
                </tr>

                @foreach ($suppliers as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>

                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->description }}</td>

                        <td>
                            {{-- @can('update-supplier') --}}
                            <a href="{{ route('suppliers.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            {{-- @endcan --}}
                            {{-- @can('delete-supplier') --}}
                            <form action="{{ route('suppliers.destroy', $item->id) }}" id="form-delete{{ $item->id }}"
                                method="post">
                                @csrf
                                @method('delete')

                            </form>
                            
                            <button class="btn btn-delete btn-danger" data-id={{ $item->id }}>Delete</button>
                            {{-- @endcan --}}
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $suppliers->links() }}
        </div>

    </div>

@endsection

@section('script')

    <script></script>
@endsection

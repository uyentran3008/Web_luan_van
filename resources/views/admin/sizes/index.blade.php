@extends('admin.layouts.app')
@section('title','Product Size')
@section('content')
<div class="card">
    <h1>Product Size List</h1>
    @if (session('message'))
        <h1 class="text-primary">{{session('message')}}</h1>
        
    @endif
    
    <div>
        <a href="{{ route('sizes.create') }}" class="btn btn-primary">CREATE</a>
    </div>
    <div>
        <table class="table table-hover">
            <th>
                <tr>
                    <th>ID</th>
                    <th>Name</th>  
                    <th>Action</th>
                </tr>
                @foreach($sizes as $size)
                    <tr>
                        <td>{{ $size->id }}</td>
                        <td>{{ $size->name }}</td>
                        
                        <td>
                            {{-- <a href="{{ route('sizes.edit', $size->id) }}" class="btn btn-warning">Edit</a> --}}
                            {{-- @can('delete-size') --}}
                            <form action="{{ route('sizes.destroy', $size->id) }}" id="form-delete{{ $size->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-delete btn-danger" type="submit" data-id="{{ $size->id }}">DELETE</button>
                            </form>
                            {{-- @endcan --}}
                        </td>
                    </tr>
                @endforeach

            </th>
        </table>
        {{ $sizes->links() }}
    </div>
</div>
@endsection

@section('script')

@endsection
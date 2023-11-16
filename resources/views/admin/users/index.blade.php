@extends('admin.layouts.app')
@section('title','Users')
@section('content')
<div class="card">
    <h1>User List</h1>
    @if (session('message'))
        <h1 class="text-primary">{{session('message')}}</h1>
        
    @endif
    
    <div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">CREATE</a>
    </div>
    <div>
        <table class="table table-hover">
            <th>
                <tr>
                    <th>ID</th>
                    {{-- <th>Image</th> --}}
                    <th>Name</th>  
                    <th>Email</th>
                    <th>Phone</th>
                    {{-- <th>Address</th> --}}
                    <th>Action</th>
                </tr>
                @foreach($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        {{-- <td><img src="{{ $item->images->count() > 0 ? asset('upload/' .$item->images->first()->url) : 'upload/default.png' }}" width="100px" height="100px" alt=""></td> --}}
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        
                        <td>
                            @can('update-user')
                            <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete-user')
                            <form action="{{ route('users.destroy', $item->id) }}" id="form-delete{{ $item->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-delete btn-danger" type="submit" data-id="{{ $item->id }}">DELETE</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach

            </th>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection


@extends('admin.layouts.app')
@section('title','Roles')
@section('content')
<div class="card">
    <h1>Role List</h1>
    @if (session('message'))
        <h1 class="text-primary">{{session('message')}}</h1>
        
    @endif
    
    <div>
        <a href="{{ route('roles.create') }}" class="btn btn-primary">CREATE</a>
    </div>
    <div>
        <table class="table table-hover">
            <th>
                <tr>
                    <th>ID</th>
                    <th>Name</th>  
                    <th>Display Name </th>
                    <th>Action</th>
                </tr>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('roles.destroy', $role->id) }}" id="form-delete{{ $role->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-delete btn-danger" type="submit" data-id="{{ $role->id }}">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </th>
        </table>
        {{ $roles->links() }}
    </div>
</div>
@endsection

@section('script')

@endsection
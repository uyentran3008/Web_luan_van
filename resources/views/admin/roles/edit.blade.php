@extends('admin.layouts.app')
@section('title','Edit Role')
@section('content')
<div class="card">
    <h1 style="text-align: center">EDIT ROLE</h1>
    <hr>
    <div>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class=" input-group input-group-static mb-4">
                    <label for="">Name</label>
                    <input type="text" value="{{ old('name') ?? $role->name }}" name="name" class="form-control">

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="">Display Name</label>
                    <input type="text" value="{{ old('display_name') ?? $role->display_name }}" name="display_name" class="form-control">

                    @error('display_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4" >
                    <label name='group' class="ms-0" >Group</label>
                    <select name="group" id="form-control"style="margin-left: 20px" value = {{ $role->group }}>
                        <option value="system">System</option>
                        <option value="user">User</option>
                    </select>

                    @error('group')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group input-group-static">
                    <label >Permission</label>
                    <div class="row">
                        @foreach($permissions as $groupName => $permission)
                        <div class="col-4">
                            <h4>{{ $groupName }}</h4>
                            <div>
                                @foreach( $permission as $item)
                                <div class="form-check">
                                    <input class="form-check-input" name="permission_ids[]" type="checkbox"  id="fcustomCheck1" {{ $role->permissions->contains('name', $item->name) ? 'checked':''}}  value="{{ $item->id }}">
                                    <label class="custom-control-label" for="customCheck1">{{ $item->display_name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-submit btn-primary" style="padding: auto;" >Submit</button>
        </form>
    </div>
</div>
@endsection
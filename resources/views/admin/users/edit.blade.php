@extends('admin.layouts.app')
@section('title','User Edit ' . $user->name)
@section('content')
<div class="card">
    <h1>User Edit</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- <div class="row">
            <div class="input-group-static col-5 mb-4">
                <label>Image</label>
                <input type="file" accept="image/*" name="image" id="image-input" class="form-control">

                @error('image')
                    <span class="text-danger">{{ message }}</span>
                @enderror
            </div>
            {{-- <div class="col-5">
                <img src="{{ $user->images ? asset('upload/' . $user->images->first()->url) : 'upload/default.png' }}" id="show-image" width="100px" height="100px" alt="">
            </div> 
        </div>     --}}
            <div class=" input-group input-group-static mb-4">
                <label for="">Name</label>
                <input type="text" value="{{ old('name') ?? $user->name }}" name="name" class="form-control">

                @error('name')
                        <span class="text-danger">
                    @enderror
            </div>
            
            <div class="input-group input-group-static mb-4">
                <label for="">Email</label>
                <input type="text" value="{{ old('email') ?? $user->email }}" name="email" class="form-control">

                @error('email')
                        <span class="text-danger">
                    @enderror
            </div>
            
            <div class="input-group input-group-static mb-4">
                <label for="">Phone</label>
                <input type="text" value="{{  old('phone') ?? $user->phone }}" name="phone" class="form-control">

                @error('phone')
                        <span class="text-danger">
                    @enderror
            </div>
            
            <div class="input-group input-group-static mb-4">
                <label for="">Address</label>
                <input type="text" value="{{ old('address') ?? $user->address }}" name="address" class="form-control">

                @error('address')
                        <span class="text-danger">
                    @enderror
            </div>

            <div class="input-group input-group-static mb-4">
                <label name="group" class="ms-0">Gender</label>
                <select name="gender" class="form-control" value={{$user->gender}}>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>FeMale</option>

                </select>

                @error('gender')
                        <span class="text-danger">
                    @enderror
            </div>
            
            <div class="input-group input-group-static mb-4">
                <label >Password</label>
                <input type="password" name="password" class="form-control">

                @error('password')
                        <span class="text-danger">
                    @enderror
            </div>

            <div class="form-group">
                <label for="">Roles</label>
                <div class="row">
                    @foreach($roles as $groupName => $role)
                    <div class="col-5">
                        {{-- <h4>{{ $groupName }}</h4> --}}
                        <div>
                            @foreach ($role as $item)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"  name="role_ids[]" {{ $user->roles->contains('id', $item->id) ? 'checked' : '' }} value="{{ $item->id }}">
                                <label for="customCheck1" class="custom-control-label" >{{ $item->display_name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @endforeach
                </div> 
            </div>
        <button type="submit" class="btn btn-submit btn-primary">Update</button>
    </form>
</div>
@endsection
@yield('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(()=>{
            function readURL(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#show-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image-input").change(function(){
                readURL(this);
            });
        });
    </script>
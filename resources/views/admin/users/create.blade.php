@extends('admin.layouts.app')
@section('title','Create User')
@section('content')
<div class="card">
    <h1 style="text-align: center">CREATE USER</h1>
    <hr>
    <div>
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- <div class="row">

                <div class=" input-group-static col-5 mb-4">
                    <label for="">Image</label>
                    <input type="file" accept="image/*" value="" name="image" id="image-input" class="form-control">
                    
                    

                    @error('image')
                        <span class="text-danger">
                    @enderror
                </div>
                <div class="col-5" ><img src="" id="show-image" width="100px" height="100px" alt=""></div>
            </div> --}}
                <div class=" input-group input-group-static mb-4">
                    <label for="">Name</label>
                    <input type="text" value="" name="name" class="form-control">

                    @error('name')
                        <span class="text-danger">
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="">Email</label>
                    <input type="email" value="" name="email" class="form-control">

                    @error('email')
                        <span class="text-danger">
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control">

                    @error('phone')
                        <span class="text-danger">
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="">Address</label>
                    <input type="text" name="address" class="form-control">

                    @error('address')
                        <span class="text-danger">
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label name="group" class="ms-0">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="fe-male">FeMale</option>
                    </select>

                    @error('gender')
                        <span class="text-danger">
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">

                    @error('password')
                        <span class="text-danger">
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Roles</label>
                    <div class="row">
                        @foreach($roles as $groupName => $role)
                        <div class="col-3">
                            {{-- <h4>{{ $groupName }}</h4> --}}
                            <div>
                                @foreach ($role as $item)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  name="role_ids[]" value="{{$item->id}}">
                                    <label for="customCheck1" class="custom-control-label" >{{ $item->display_name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @endforeach
                    </div>

                    

                </div>
            {{-- </div> --}}
            <button type="submit" class="btn btn-submit btn-primary" style="padding: auto;" >Submit</button>
        </form>
    </div>
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

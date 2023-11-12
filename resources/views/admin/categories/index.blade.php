@extends('admin.layouts.app')
@section('title', 'Category')
@section('content')
<div class="card">
    <h1 class="text-primary"> Category List</h1>

    @if (session('message'))
    <h1 class="text-primary">{{ session('message') }}</h1>
    @endif

    <div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create</a>
    </div>
    <div>
        <table class="table table-hover">
            <th>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent_name</th>
                    <th>Action</th>
                </tr>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->parent_name }}</td>
                        <td>
                            @can('update-category')
                            <a href="{{  route('categories.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete-category')
                            <form action="{{ route('categories.destroy', $item->id) }}" id="form-delete{{ $item->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-delete btn-danger" data-id={{$item->id  }}>Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </th>
        </table>
        {{ $categories->links() }}
    </div>
</div>
@endsection

{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(() => {
        function confirmDelete(){
            return new Promise(resolve,reject) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        resolve(true)
                    }else{
                        reject(false)
                    }
                })
            }
        }
        $(document).on('click','.btn-delete',function(e){
            e.prevenDefault();
            let id = $(this).data('id');
            confirmDelete.then(function(){
                $(`#form-delete${id}`).submit();
            }).catch();
        })
    })
</script> --}}


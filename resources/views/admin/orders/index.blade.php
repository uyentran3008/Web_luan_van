@extends('admin.layouts.app')
@section('title', 'Orders')
@section('content')

    <div class="card">

        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif


        <h1>
            Orders
        </h1>
        <div class="container-fluid ">
            @if (session('message'))
                <h1 class="text-primary">{{ session('message') }}</h1>
            @endif


            <div class="col">
                <div>
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>

                            <th>Status</th>
                            <th>Total</th>
                            {{-- <th>Ship</th> --}}
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Address</th>
                            <th>Note</th>
                            <th>Payment</th>
                            <th>Time Complele</th>
                            
                        </tr>

                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>

                                <td>
                                    
                                    <div class="input-group input-group-static mb-4">
                                        <select name="status" class="form-control select-status"
                                            data-action="{{ route('admin.orders.update_status', $item->id)}}">
                                            
                                             @foreach (config('order.status') as $station)
                                             {{ $item->status }}
                                                 <option value="{{ $station }}"
                                                     {{ $item->status ==  $station ? 'selected' : '' }}>{{ $station }}
                                                 </option>
                                             @endforeach 
                                         </select>

                                </td>
                                <td>{{ $item->total }} VNĐ</td>

                                {{-- <td>{{ $item->ship }} VNĐ</td> --}}
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->customer_email }}</td>

                                <td>{{ $item->customer_address }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->payment }}</td>
                                <td>{{ $item->updated_at->format('d/m/Y') }}</td>
                                
                            </tr>
                        @endforeach
                    </table>
                    {{-- {{ $orders->links() }} --}}
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {

            $(document).on("change", ".select-status", function(e) {
                e.preventDefault();
                let url = $(this).data("action");
                let data = {
                    status: $(this).val()
                };
                $.post(url, data, res => {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                });
            });

        });
    </script>

@endsection


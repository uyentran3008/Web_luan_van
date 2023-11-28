  <!-- Featured Start -->
  @extends('client.layouts.app')
  @section('title', 'Home')
  @section('content')
  <div class="d-inline-flex" style="margin-left: 40px">
    <div class="row">
        <p class="m-0"><a href="{{ route('client.home') }}">Home</a></p>
        <p class="m-0 px-2">/</p>
        <p class="m-0">Order List</p>
    </div>
</div>
      <div class="container-fluid ">
          @if (session('message'))
              <h1 class="text-primary">{{ session('message') }}</h1>
          @endif


          <div class="col" style="padding-top: 40px">
              <div>
                  <table class="table table-hover">
                    <tr class="" style="text-align: center">Order List</tr>
                      <tr>
                          <th>#</th>

                          <th>Status</th>
                          <th>Total</th>
                          <th>Ship</th>
                          <th>Customer Name</th>
                          <th>Customer Email</th>
                          <th>Customer Address</th>
                          <th>Note</th>
                          <th>Payment</th>
                          <th>Created at</th>
                          {{-- <th>Action</th> --}}


                      </tr>

                      @foreach ($orders as $item)
                          <tr>
                              <td>{{ $item->id }}</td>

                              <td>{{ $item->status }}</td>
                              <td>{{ $item->total }} VNĐ</td>

                              <td>{{ $item->ship }} VNĐ</td>
                              <td>{{ $item->customer_name }}</td>
                              <td>{{ $item->customer_email }}</td>

                              <td>{{ $item->customer_address }}</td>
                              <td>{{ $item->note }}</td>
                              <td>{{ $item->payment }}</td>
                              <th>{{ $item->created_at }}</th>
                              {{-- <td>
                                  @if ($item->status == 'pending')
                                      <form action="{{ route('client.orders.cancel', $item->id) }}"
                                          id="form-cancel{{ $item->id }}" method="post" >
                                          @csrf
                                          <button class="btn btn-cancel btn-danger" data-id={{ $item->id }}>Cancel
                                              Order</button>
                                      </form>
                                  @endif

                              </td> --}}
                          </tr>
                      @endforeach
                  </table>
                  {{ $orders->links() }}
              </div>
          </div>

      </div>
  @endsection
  @section('scripts')
      <script>
          $(function() {

              $(document).on("click", ".btn-cancel", function(e) {
                  e.preventDefault();
                  let id = $(this).data("id");
                  confirmDelete()
                      .then(function() {
                          $(`#form-cancel${id}`).submit();
                      })
                      .catch();
              });

          });
      </script>

  @endsection

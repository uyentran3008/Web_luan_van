  <!-- Featured Start -->
  @extends('client.layouts.app')
  @section('title', 'Home')
  @section('content')
      <div class="container-fluid ">
          @if (session('message'))
              <h1 class="text-primary">{{ session('message') }}</h1>
          @endif


          <div class="col">
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
                          <th>Action</th>


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
                              <td>
                                  @if ($item->status == 'pending')
                                      <form action="{{ route('client.orders.cancel', $item->id) }}"
                                          id="form-cancel{{ $item->id }}" method="post" >
                                          @csrf
                                          <button class="btn btn-cancel btn-danger" data-id={{ $item->id }}>Cancel
                                              Order</button>
                                      </form>
                                  @endif

                              </td>
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

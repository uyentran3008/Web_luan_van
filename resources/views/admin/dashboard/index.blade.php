@extends('admin.layouts.app')

@section('content')
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">weekend</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">Product</p>
          <h4 class="mb-0">{{ $countProduct }}</h4>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><a href="{{route('products.index') }}">View Detail</a></span></p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">person</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">Category</p>
          <h4 class="mb-0">{{ $countCategory }}</h4>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><a href="{{route('categories.index') }}">View Detail</a></span></p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">person</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">User</p>
          <h4 class="mb-0">{{ $countUser }}</h4>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="{{route('users.index') }}">View Detail</a></span></p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">weekend</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">Order</p>
          <h4 class="mb-0">{{ $countOrder }}</h4>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><a href="{{route('admin.orders.index') }}">View Detail</a></span></p>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <h3>Raw material import and export statistics</h3>

  <form method="get">
      <label for="selected_month">Select Month:</label>
      <select name="selected_month" id="selected_month">
          @for ($month = 1; $month <= 12; $month++)
              <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                  {{ Carbon\Carbon::createFromDate(null, $month)->monthName }}
              </option>
          @endfor
      </select>
      <button type="submit" class="btn btn-primary">Show Summary</button>
  </form>

  @if ($totalInputCost !== null && $totalExportCost !== null)
            <p style="font-size: 20px; color: black">Total Raw Material Import Cost in {{ Carbon\Carbon::createFromDate(null, $selectedMonth)->monthName }}: {{ $totalInputCost }} VNĐ</p>
            <p style="font-size: 20px; color: black">Total Raw Material Export Cost in {{ Carbon\Carbon::createFromDate(null, $selectedMonth)->monthName }}: {{ $totalExportCost }} VNĐ</p>
        @else
            <p>No data available for the selected month.</p>
        @endif
</div>
<div class="container">
  <h3>Statistical Dashboard</h3>

  <form method="get">
      <label for="start_date">Start Date:</label>
      <input type="date" name="start_date" value="{{ $startDate }}">

      <label for="end_date">End Date:</label>
      <input type="date" name="end_date" value="{{ $endDate }}">

      <button type="submit" class="btn btn-primary">Show Statistics</button>
  </form>

  @if ($statisticData->isEmpty())
      <p>No data available for the selected date range.</p>
  @else
      {{-- Example: Display data in a table --}}
      <table class="table table-hover">
          <thead>
              <tr>
                  <th>Date</th>
                  <th>Order Count</th>
                  <th>Total Revenue</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($statisticData as $data)
                  <tr>
                      <td>{{ $data->date }}</td>
                      <td>{{ $data->order_count }}</td>
                      <td>{{ $data->total_revenue }}</td>
                  </tr>
              @endforeach
          </tbody>
          <thead>
            <tr>
                <th>Total</th>
                <th>{{ $totalOrder }}</th>
                <th>{{ $totalRevenue }}</th>
            </tr>
        </thead>
      </table>

      {{-- Example: Display data in a chart (using Chart.js) --}}
      <canvas id="statisticChart" width="400" height="200"></canvas>

      <script>
          var ctx = document.getElementById('statisticChart').getContext('2d');
          var labels = @json($statisticData->pluck('date'));
          var orderCountData = @json($statisticData->pluck('order_count'));
          var totalRevenueData = @json($statisticData->pluck('total_revenue'));

          var statisticChart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Order Count',
                      data: orderCountData,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                  }, {
                      label: 'Total Revenue',
                      data: totalRevenueData,
                      backgroundColor: 'rgba(255, 99, 132, 0.2)',
                      borderColor: 'rgba(255, 99, 132, 1)',
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
      </script>
  @endif
</div>
@endsection
{{-- @endsection --}}
{{-- /*
 *  File Name              :
 *  Type                   :   
 *  Description            :   
 *  Author                 : Ashtosh Kumar Choubey
 *  Contact                : 9658476170
 *  Email                  : ashutoshphoenixsoft@gmail.com
 *  Date                   : 12/12/2018  
 *  Modified By            :       
 *  Date of Modification   :     
 *  Purpose of Modification: 
 * 
 */ --}}
@extends('samples') 
@section('content')
@php
 $role_id=Auth::user()->role_id;
@endphp
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      @if($role_id==1)
      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-primary">

          <div class="card-body pb-0">
            <div class="btn-group float-right">
              <button type="button" class="btn btn-transparent dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-settings"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ url('/') }}/SaiAutoCare/workshop/search">Search Workshop</a>
                <a class="dropdown-item" href="{{ url('/') }}/SaiAutoCare/sale/add">Sale Spare</a>
                <a class="dropdown-item" href="{{ url('/') }}/SaiAutoCare/sale/sale_return">Return Spare Log</a>
              </div>
            </div>
           {{--  <h4 class="mb-0">{{ $totalPendingJob }}</h4> --}}
            <a href="{{ url('/') }}/SaiAutoCare/workshop/add"><p style="color:white">Job Sheet</p></a>
            
          </div>
          <div class="chart-wrapper px-3" style="height:70px;">
            <canvas id="card-chart1" class="chart" height="70"></canvas>
          </div>
        </div>
      </div>
      <!--/.col-->

      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-info">
          <div class="card-body pb-0">
            <button type="button" class="btn btn-transparent p-0 float-right">
              <i class="icon-location-pin"></i>
            </button>
            <h4 class="mb-0">{{ $totalPendingJob }}</h4>
            <p>Pending Job</p>
          </div>
          <div class="chart-wrapper px-3" style="height:70px;">
            <canvas id="card-chart2" class="chart" height="70"></canvas>
          </div>
        </div>
      </div>
      <!--/.col-->

      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-warning">
          <div class="card-body pb-0">
            <div class="btn-group float-right">
              <button type="button" class="btn btn-transparent dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-settings"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ url('/') }}/SaiAutoCare/workshop/search">Purchase Search</a>
                <a class="dropdown-item" href="{{ url('/') }}/SaiAutoCare/purchase/purhase_return">Purchase Return</a>
                {{-- <a class="dropdown-item" href="{{ url('/') }}/SaiAutoCare/workshop/search">Something else here</a> --}}
              </div>
            </div>
            <h4 class="mb-0">{{ $TotalPurchasePrice }}</h4>
             <a href="{{ url('/') }}/SaiAutoCare/workshop/add"><p style="color:white">Purchase</p></a>
          </div>
          <div class="chart-wrapper" style="height:70px;">
            <canvas id="card-chart3" class="chart" height="70"></canvas>
          </div>
        </div>
      </div>
      <!--/.col-->

      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-danger">
          <div class="card-body pb-0">
            <div class="btn-group float-right">
              <button type="button" class="btn btn-transparent dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-settings"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ url('/') }}/CustomerCreditDebitLog/add">Customer Payment Log</a>
              {{--   <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a> --}}
              </div>
            </div>
            <h4 class="mb-0">{{ $TotalCustomers }}</h4>
            <a href="{{ url('/') }}/SaiAutoCare/customer/add"><p style="color:white">Customer</p></a>
          </div>
          <div class="chart-wrapper px-3" style="height:70px;">
            <canvas id="card-chart4" class="chart" height="70"></canvas>
          </div>
        </div>
      </div>
      @else
        <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-info">
          <div class="card-body pb-0">
           <div>Welcome</div>
          </div>
          <div class="chart-wrapper px-3" style="height:70px;">
            <canvas id="card-chart4" class="chart" height="70"></canvas>
          </div>
        </div>
      </div>
       @endif
      <!--/.col-->
    </div>
    <!--/.row-->

   
                  
    <!--/.row-->
  </div>

</div>
@endsection
<!-- /.conainer-fluid -->

@section('myscript')
 <!--  <script src="{{ asset('js/views/main.js') }}"></script> -->
@endsection
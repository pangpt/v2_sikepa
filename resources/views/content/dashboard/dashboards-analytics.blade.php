@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Selamat datang {{@Auth::user()->employee->nama}}! 🎉</h5>
            <p class="mb-4">Anda berada di halaman <span class="fw-bold">Sistem Informasi Kepegawaian PA Watampone</span></p>

            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">

    </div>
  </div>

  <!--/ Total Revenue -->
  <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
    <div class="row">
      <div class="col-3 mb-4">
        <div class="card">
          <div class="card-body">
            <span class="fw-semibold d-block mb-1">Total Hakim</span>
            <h3 class="card-title mb-2">{{$hakimCount}}</h3>
          </div>
        </div>
      </div>
      <div class="col-3 mb-4">
        <div class="card">
          <div class="card-body">
            <span>Total Struktural</span>
            <h3 class="card-title text-nowrap mb-1">{{$strukturalCount}}</h3>
          </div>
        </div>
      </div>
      <div class="col-3 mb-4">
        <div class="card">
          <div class="card-body">
            <span class="d-block mb-1">Total Fungsional</span>
            <h3 class="card-title text-nowrap mb-2">{{$fungsionalCount}}</h3>
          </div>
        </div>
      </div>
      <div class="col-3 mb-4">
        <div class="card">
          <div class="card-body">
            <span class="fw-semibold d-block mb-1">Total Keseluruhan</span>
            <h3 class="card-title mb-2">{{$hakimCount + $strukturalCount + $fungsionalCount}}</h3>
          </div>
        </div>
      </div>
      <!-- </div>
    <div class="row"> -->
    </div>
  </div>
</div>
<div class="row">
  <!-- Order Statistics -->
  <div class="col-md-6 col-lg-6 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Reminder Pensiun Hakim</h5>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">8,258</h2>
            <span>Total Orders</span>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->

  <!-- Transactions -->
  <div class="col-md-6 col-lg-6 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Reminder Pensiun Pegawai</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Transactions -->
</div>
@endsection

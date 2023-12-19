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

            {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> --}}
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
  {{-- <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
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
  </div> --}}
</div>
<div class="row">
  <!-- Order Statistics -->
  <div class="col-md-12 col-lg-12 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Informasi</h5>
        </div>
        <div class="dropdown">
          <small class="text-muted float-end">Total: 1 Item</small>
        </div>
      </div>
      <div class="card-body">
        <div class="col-md mb-4 mb-md-0">
          <div class="accordion mt-3" id="accordionExample">
            @foreach($info as $key)
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion{{ $loop->iteration }}" aria-expanded="true" aria-controls="accordionOne">
                  <span class="fw-bold">{{$key->judul}}</span>
                </button>
              </h2>

              <div id="accordion{{ $loop->iteration }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#accordionExample">
                <div class="accordion-body m-4">
                  {!!$key->isi_konten!!}
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

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
<div class="row text-center">
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2">{{$errorType}} :(</h2>
      <p class="mb-4 mx-2">Oops! 😖 Sepertinya data tidak ada, silahkan kembali ke halaman dashboard atau hubungi pengembang.</p>
      <a href="{{url('/dashboard')}}" class="btn btn-primary">Kembali ke halaman dashboard</a>
      <div class="mt-3">
        <img src="{{asset('assets/img/illustrations/page-misc-error-light.png')}}" alt="page-misc-error-light" width="500" class="img-fluid">
      </div>
    </div>
  </div>
</div>

@endsection

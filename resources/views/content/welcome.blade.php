@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Without menu - Layouts')

@section('content')

<!-- Layout Demo -->
<div class="layout-demo-wrapper">
  <div class="col-sm-5 text-center text-sm-center">
    <div class="card-body pb-0 px-0 px-md-4">
      <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="240" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
    </div>
    <h4>Layanan Kepegawaian</h4>
  </div>
  <div class="row mb-5">
    <div class="col-md-6 col-lg-4">
      <div class="card text-center mb-3">
        <div class="card-body">
          <h5 class="card-title">Pengajuan Izin Cuti</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="{{route('izin-cuti-tambah')}}" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card text-center mb-3">
        <div class="card-body">
          <h5 class="card-title">Pengajuan PKP - PCK</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card text-center mb-3">
        <div class="card-body">
          <h5 class="card-title">Usulan Lembur</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
  <div class="layout-demo-info">
    <a href="{{route('dashboard-analytics')}}" class="btn btn-primary" type="button">Halama Utama <span class="tf-icons bx bx-chevron-right"></span></a>
  </div>
</div>
<!--/ Layout Demo -->

@endsection

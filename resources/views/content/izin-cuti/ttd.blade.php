@extends('layouts/blankLayout')

@section('title', 'Under Maintenance - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-misc.css')}}">
@endsection

@section('content')
<!--Under Maintenance -->
<div class="container-xxl container-p-y">
    <div class="card mt-4">
      <div class="card-header align-items-center justify-content-between pb-0">
        <div class="card-title mb-4 text-center">
          <h3 class="m-2 me-2">Permohonan Izin Cuti</h3>
          <h5 class="m-0 me-2">Ditandatangani secara elektronik oleh :</h5>
        </div>
      </div>
      <div class="card-body mt-4">
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-user-check'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            </div>
            <div class="me-2">
            </div>
            <div class="user-progress ml-auto" style="white-space: nowrap;">
              <h5 class="fw-semibold">{{$ketua->nama}}</h5>
            </div>
          </li>
          <hr>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class='bx bx-key'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            </div>
            <div class="me-2">
            </div>
            <div class="user-progress" style="white-space: nowrap;">
              <h5 class="fw-semibold">{{$ketua->nip}}</h5>
            </div>
          </li>
          <hr>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-info"><i class='bx bx-calendar'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            </div>
            <div class="me-2">
            </div>
            <div class="user-progress" style="white-space: nowrap;">
              <h5 class="fw-semibold">{{ strftime('%d %B %Y', strtotime($izinCuti->updated_at)) }}</h5>
            </div>
          </li>
          <hr>
          <li class="d-flex">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-secondary"><i class='bx bx-file-blank'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
              </div>
              <div class="user-progress">
                <h5 class="fw-semibold">Download Dokumen</h5>
              </div>
            </div>
          </li>
        </ul>
      </div>
  </div>
</div>
<!-- /Under Maintenance -->
@endsection

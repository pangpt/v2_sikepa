@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Pages')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Profil / </span> Kepangkatan
</h4>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link" href="{{route('profil-pegawai-detail')}}"><i class="bx bx-user me-1"></i> Data Pribadi</a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('profil-pegawai-permohonan-cuti')}}"><i class="bx bx-bell me-1"></i> Data Cuti</a></li>
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-link-alt me-1"></i> Data Kepangkatan</a></li>
    </ul>
    <div class="row">
      <div class="col-md-12 col-12 mb-md-0 mb-4">
        <div class="card">
          <div class="container-xxl container-p-y divider">
            <div class="misc-wrapper">
              <h2 class="mb-2 mx-2">COming Soon!</h2>
              <p class="mb-4 mx-2">
                Sorry for the inconvenience but we're performing some maintenance at the moment
              </p>
              <div class="mt-4">
                <img src="{{asset('assets/img/illustrations/girl-doing-yoga-light.png')}}" alt="girl-doing-yoga-light" width="500" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Pages')
<style>
ul.timeline {
        list-style-type: none;
        position: relative;
      }
      ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
      }
      ul.timeline > li {
        margin: 20px 0;
        padding-left: 20px;
      }
      ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
      }
      ul.timeline > li.active:before {
        /* Change the color to the desired primary color */
        background: #007bff;
      }
</style>
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account Settings /</span> Notifications
</h4>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-account')}}"><i class="bx bx-user me-1"></i> Data Pribadi</a></li>
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-bell me-1"></i> Data Cuti</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Data Kepangkatan</a></li>
    </ul>
    <div class="row">
      <div class="col-md-4 col-12 mb-md-0 mb-4">
        <div class="card">
          <h5 class="card-header">Catatan Cuti</h5>
          <div class="card-body">
            <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-nowrap">Cuti</th>
              <th class="text-nowrap text-center">Tahun</th>
              <th class="text-nowrap text-center">Sisa</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-nowrap">Tahunan</td>
              <td>
                2020
              </td>
              <td>
                0
              </td>
            </tr>
            <tr>
              <td class="text-nowrap">Tahunan</td>
              <td>
                2021
              </td>
              <td>
                6
              </td>
            </tr>
            <tr>
              <td class="text-nowrap">Tahunan</td>
              <td>
                2023
              </td>
              <td>
                12
              </td>
            </tr>
          </tbody>
        </table>
      </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-4">
      <!-- Notifications -->
      <h5 class="card-header">Tracking Permohonan Cuti</h5>
      <div class="card-body">
			<ul class="timeline">
				<li class="active">
					<div class="d-flex mb-3">
              <div class="flex-grow-1 row">
                <div class="col-9 mb-sm-0 mb-2">
                  <h6 class="mb-0">Disetujui Atasan Langsung</h6>
                  <small class="text-muted">Panggih Tridarma, S.Kom.</small>
                </div>
                <div class="col-3 text-end">
                  <h6 class="mb-0">21 Juli 2023</h6>
                </div>
              </div>
            </div>
				</li>
        <li>
					<div class="d-flex mb-3">
              <div class="flex-grow-1 row">
                <div class="col-9 mb-sm-0 mb-2">
                  <h6 class="mb-0">Disetujui Ketua Pengadilan</h6>
                  <small class="text-muted">Panggih Tridarma, S.Kom.</small>
                </div>
                <div class="col-3 text-end">
                  <h6 class="mb-0">25 Juli 2023</h6>
                </div>
              </div>
            </div>
				</li>
        <li>
					<div class="d-flex mb-3">
              <div class="flex-grow-1 row">
                <div class="col-9 mb-sm-0 mb-2">
                  <h6 class="mb-0">Verifikasi</h6>
                  <small class="text-muted">Panggih Tridarma, S.Kom.</small>
                </div>
                <div class="col-3 text-end">
                  <h6 class="mb-0">21 Juli 2023</h6>
                </div>
              </div>
            </div>
				</li>
        <li>
					<div class="d-flex mb-3">
              <div class="flex-grow-1 row">
                <div class="col-9 mb-sm-0 mb-2">
                  <h6 class="mb-0">Pengajuan Cuti Diterima</h6>
                  <small class="text-muted">Panggih Tridarma, S.Kom.</small>
                </div>
                <div class="col-3 text-end">
                  <h6 class="mb-0">21 Juli 2023</h6>
                </div>
              </div>
            </div>
				</li>
			</ul>
      </div>
      <!-- /Notifications -->
    </div>
      </div>
    </div>
    
  </div>
</div>
@endsection

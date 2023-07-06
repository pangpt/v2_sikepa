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
  <span class="text-muted fw-light">Profil /</span> Data Cuti
</h4>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link" href="{{route('profil-pegawai-detail')}}"><i class="bx bx-user me-1"></i> Data Pribadi</a></li>
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-bell me-1"></i> Data Cuti</a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('profil-pegawai-kepangkatan')}}"><i class="bx bx-link-alt me-1"></i> Data Kepangkatan</a></li>
    </ul>
    <div class="row">
      <div class="col-md-6 col-6 mb-md-0 mb-4">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between pb-0 mb-4">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Data Permohonan</h5>
            </div>
            <div class="dropdown">
              <a href="{{route('izin-cuti-tambah')}}" type="button" class="btn btn-primary text-end">Form Pengajuan Cuti</a>
            </div>
          </div>
          {{-- <h5 class="card-header">Data Permohonan</h5>
          <button type="submit" class="btn btn-primary text-end">Simpan</button> --}}
          <div class="card-body">
            <table class="table table-striped table-borderless border-bottom">
              <thead>
                <tr>
                  <th class="text-nowrap"></th>
                  <th class="text-nowrap text-center"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><h6 class="fw-bold">Status Permohonan</h6></td>
                  <td><h6>Disetujui atasan langsung</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Jenis Cuti</h6></td>
                  <td><h6>Cuti Tahun</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Alasan Cuti</h6></td>
                  <td><h6>Ada kepentingan</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Lama Cuti</h6></td>
                  <td><h6>1 hari</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Periode</h6></td>
                  <td><h6>20 Juli 2023 s/d 20 Juli Juli 2023</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Alamat Saat Cuti</h6></td>
                  <td><h6>Semarang, Jawa Tengah</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">No. Tlp Saat Cuti</h6></td>
                  <td><h6>0888291912021</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Atasan Langsung</h6></td>
                  <td><h6>Panggih Tridarma, S.Kom.</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Ketua Pengadilan</h6></td>
                  <td><h6>Dra. Hj. Heriyah, S.H., M.H. </h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Lampiran</h6></td>
                  <td><h6>-</h6></td>
                </tr>
                <tr>
                  <td><h6 class="fw-bold">Dokumen</h6></td>
                  <td><h6><a href="">Lihat Dokumen Persetujuan Cuti</a></h6></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <h5 class="card-header">Tracking Permohonan Cuti</h5>
          <div class="card-body">
            <ul class="timeline">
              <li class="active">
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
              <li>
                <div class="d-flex mb-3">
                    <div class="flex-grow-1 row">
                      <div class="col-9 mb-sm-0 mb-2">
                        <h6 class="mb-0">Verifikasi</h6>
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
                        <h6 class="mb-0">21 Juli 2023</h6>
                      </div>
                    </div>
                  </div>
              </li>
            </ul>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', ' Profil Hakim dan Pegawai')

@section('content')PNS
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan/</span> Akun</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <a href="#" class="btn btn-primary">
          <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah
        </a> <small class="text-muted float-end">Total Akun: 50 aktif</small>
      </div>
      <div class="card-body">
        <h6 class="mb-4 text-muted"><span class="tf-icons bx bx-info-circle"></span>Klik Nama Lengkap untuk melihat data detail</h6>
        <table id="pegawaiTable" class="display">
          <thead>
            <tr>
              <th>Username</th>
              <th>Role Pengguna</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $key)
            <tr>
              <td>{{$key->username}}</td>
              <td>{{$key->role}}</td>
              <td>@if ($key->is_active == 1)
                    AKTIF
              @else
                    TIDAK AKTIF
              @endif</td>
              <td><div class="dropdown">
                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                  <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);">Hapus</a>
                  <a class="dropdown-item" href="javascript:void(0);">Nonaktifkan</a>
                </div>
              </div></td>
            </tr>
            @endforeach
            <!-- Tambahkan baris data pegawai dan hakim lainnya di sini -->
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

@endsection
@section('page-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#pegawaiTable').DataTable({
        "ordering": false, // Menonaktifkan fitur pengurutan (sort)
        "language": {
          "searchPlaceholder": "NIP / Nama" // Menambahkan placeholder pada input search
        }
      });
    });
  </script>
@endsection

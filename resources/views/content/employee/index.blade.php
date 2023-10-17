@extends('layouts/contentNavbarLayout')

@section('title', ' Profil Hakim dan Pegawai')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profil Hakim dan Pegawai/</span> PNS</h4>

<!-- Basic Layout -->
@if (session('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
      </button>
    </div>
    @endif
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <a href="{{route('profil-hakim-pegawai-create')}}" class="btn btn-primary">
          <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah
        </a> <small class="text-muted float-end">Total PNS: 50 aktif</small>
      </div>
      <div class="card-body">
        <h6 class="mb-4 text-muted"><span class="tf-icons bx bx-info-circle"></span>Klik Nama Lengkap untuk melihat data detail</h6>
        <table id="pegawaiTable" class="display">
          <thead>
            <tr>
              <th>Profil</th>
              <th>Jabatan</th>
              <th>Golongan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $key)
            <tr>
              <td><a href="{{route('profil-pegawai-detail',['nip' => $key->nip])}}">{{$key->nama}}</a><br>NIP: {{$key->nip}}<br>Tgl. Lahir: {{$key->tanggal_lahir}}</td>
              <td>{{$key->department->nama_jabatan}}</td>
              <td>{{$key->golongan->jenis_golongan}} - {{$key->golongan->pangkat}}</td>
              <td>AKTIF</td>
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

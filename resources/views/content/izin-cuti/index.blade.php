@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center">
        <a href="{{route('izin-cuti-tambah')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Pengajuan Cuti
        </a>
        <a href="{{route('izin-cuti-penangguhan')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Ajukan Penangguhan
        </a>
        <button type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-check-square"></span>&nbsp; Verifikasi Cuti (5)
        </button>
        <button type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-check-square"></span>&nbsp; Approval Cuti (Atasan)
        </button>
        <small class="text-muted float-end">Total: 1 Izin Cuti</small>
      </div>
      <div class="card-body">
        <h6 class="mb-4 text-muted">Klik Nama Lengkap untuk melihat data detail</h6>
        <table id="pegawaiTable" class="display">
          <thead>
            <tr>
              <th>Tanggal Pengajuan</th>
              <th>Nama</th>
              <th>Jenis Cuti</th>
              <th>Tanggal Cuti</th>
              <th>Lama Cuti</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2023-04-04 10:32:24</td>
              <td><a href="">Panggih Tridarma, S.Kom. </a></td>
              <td>Cuti Tahunan</td>
              <td>22 Juni 2023 <b>s/d</b> 06 Juli 2023</td>
              <td>14 hari</td>
              <td>Disetujui Atasan</td>
            </tr>
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

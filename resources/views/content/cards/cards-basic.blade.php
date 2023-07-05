@extends('layouts/contentNavbarLayout')

@section('title', ' Profil Hakim dan Pegawai')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profil Hakim dan Pegawai/</span> PNS</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah
        </button> <small class="text-muted float-end">Total PNS: 50 aktif</small>
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
            <tr>
              <td><a href="{{route('profil-pegawai-detail')}}">Panggih Tridarma, S.Kom.</a><br>NIP: 199609022020121004<br>Tgl. Lahir: 02 September 1996</td>
              <td>Pranata Komputer Ahli Pertama</td>
              <td>Penata Muda - III/a</td>
              <td>AKTIF</td>
            </tr>
            <tr>
              <td><a href="">Prabowo Subianto</a><br>NIP: 00000000000001<br>Tgl. Lahir: 02 September 1954</td>
              <td>Presiden Republik Indonesia</td>
              <td>RI 1</td>
              <td>AKTIF</td>
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

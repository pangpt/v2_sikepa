@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center">
        <a href="{{route('layanan-pkp')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-left-arrow-alt"></span>
        </a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#indikatorModal">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Indikator Baru
        </button>
        <small class="text-muted float-end">Total: 1 Indikator</small>
      </div>
      <div class="card-body">
        <h6 class="mb-4 text-muted">Daftar Indikator baru yang diajukan pegawai</h6>
        <table id="pegawaiTable" class="display">
          <thead>
            <tr>
              <th>#</th>
              <th>Butir Kegiatan</th>
              <th>Hasil</th>
              <th>Pemohon</th>
              <th>Status</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Surat usulan kenaikan gaji berkala (KGB) hakim dan/atau pegawai<br><span style="color:red">Alasan ditolak: salah</span></td>
              <td>Data Elektronik</td>
              <td>Panggih Tridarma, S.Kom.<br>199609022020121004</td>
              <td><span class="badge bg-danger">DITOLAK</span></td>
              <td>8 Agustus 2023</td>
            </tr>
            <!-- Tambahkan baris data pegawai dan hakim lainnya di sini -->
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="indikatorModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Tambah Indikator Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Butir Kegiatan</label>
            <input class="form-control" type="text"/>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Hasil</label>
            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
              <option selected>Pilih</option>
              <option value="1">Artikel</option>
              <option value="2">Data Amar</option>
              <option value="3">Dokumen</option>
              <option value="3">BAS</option>
              <option value="3">Data perkara</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Ajukan</button>
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
          "searchPlaceholder": "Ketik di sini untuk mencari PKP berdasarkan Nama, Atasan Langsung, atau Periode." // Menambahkan placeholder pada input search
        }
      });
    });
  </script>
@endsection

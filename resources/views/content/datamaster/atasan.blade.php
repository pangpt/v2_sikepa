@extends('layouts/contentNavbarLayout')

@section('title', ' Profil Hakim dan Pegawai')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan/</span> Daftar Pejabat Struktural</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahStrukturalModal">
          <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah
        </a> <small class="text-muted float-end">Total Jabatan: 50 aktif</small>
      </div>
      <div class="card-body">
        {{-- <h6 class="mb-4 text-muted"><span class="tf-icons bx bx-info-circle"></span>Klik Nama Lengkap untuk melihat data detail</h6> --}}
        <table id="strukturalTable" class="display">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Jabatan</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($struktural as $key)
            <tr>
              <td>{{$key->nama}}</td>
              <td>{{$key->department->nama_jabatan}}</td>
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

<!-- Modal Tambah Jabatan -->
<div class="modal fade" id="tambahStrukturalModal" tabindex="-1" aria-labelledby="tambahStrukturalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahStrukturalModalLabel">Tambah Struktural</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form input untuk data jabatan -->
        <form id="formTambahStruktural">
          @csrf
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Pegawai</label>
              <input class="form-control" list="datalistOptions" name="nama" id="exampleDataList" placeholder="Ketik untuk mencari...">
              <datalist id="datalistOptions">
                @foreach($employee as $key)
                <option value="{{$key->nama}}">
                @endforeach
              </datalist>
          </div>
          <div class="mb-3">
            <label for="department_id" class="form-label">Jabatan</label>
            <select class="form-select" id="department_id" name="department_id">
              <option value="">- Pilih Jabatan -</option>
              @foreach($jabatan as $item)
                <option value="{{$item->id}}">{{$item->nama_jabatan}}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="simpanStruktural">Simpan</button>
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
      $('#strukturalTable').DataTable({
        "pageLength": 25,
        "ordering": false, // Menonaktifkan fitur pengurutan (sort)
        "language": {
          "searchPlaceholder": "Nama / Jabatan" // Menambahkan placeholder pada input search
        }
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
  const formTambahStruktural = document.getElementById('formTambahStruktural');
  const simpanStrukturalButton = document.getElementById('simpanStruktural');
  const namaStrukturalInput = document.getElementById('nama');


  simpanStrukturalButton.addEventListener('click', function() {
    // Mengambil data dari form
    const formData = new FormData(formTambahStruktural);

    // Kirim data ke server melalui Ajax
    $.ajax({
      method: 'POST',
      url: "{{ route('datamaster-struktural-create')}}",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        // Handle respons dari server
        console.log(response);
        // Tutup modal
        $('#tambahStrukturalModal').modal('hide');
        // Tampilkan pesan sukses menggunakan alert atau yang lainnya
        alert('Struktural berhasil ditambahkan.');
        location.reload();

      },
      error: function(response) {
        // Handle error jika terjadi
        console.error('Terjadi kesalahan: ' + response.responseJSON.message);
      }
    });
  });
});

  </script>
@endsection

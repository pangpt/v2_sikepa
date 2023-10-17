@extends('layouts/contentNavbarLayout')

@section('title', ' Profil Hakim dan Pegawai')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan/</span> Akun</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahJabatanModal">
          <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah
        </a> <small class="text-muted float-end">Total Jabatan: 50 aktif</small>
      </div>
      <div class="card-body">
        {{-- <h6 class="mb-4 text-muted"><span class="tf-icons bx bx-info-circle"></span>Klik Nama Lengkap untuk melihat data detail</h6> --}}
        <table id="jabatanTable" class="display">
          <thead>
            <tr>
              <th>Nama Jabatan</th>
              <th>Atasan Langsung</th>
              <th>Deskripsi</th>
              <th>Kategori</th>
              <th>Termasuk Atasan</th>
              <th>Slug</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($jabatan as $key)
            <tr>
              <td>{{@$key->nama_jabatan}}</td>
              <td>{{@$key->parent->nama_jabatan}}</td>
              <td>{{@$key->deskripsi}}</td>
              <td>{{@$key->kategori}}</td>
              <td>YA</td>
              <td>{{@$key->slug}}</td>
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
<div class="modal fade" id="tambahJabatanModal" tabindex="-1" aria-labelledby="tambahJabatanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahJabatanModalLabel">Tambah Jabatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form input untuk data jabatan -->
        <form id="formTambahJabatan">
          @csrf
          <div class="mb-3">
            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
          </div>
          <div class="mb-3">
            <label for="atasan_langsung" class="form-label">Atasan Langsung</label>
            <select class="form-select" id="parent_id" name="parent_id">
              <option value="">- Pilih Atasan Langsung -</option>
              @foreach($jabatan as $item)
                <option value="{{$item->id}}">{{$item->nama_jabatan}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori">
              <option value="">- Pilih Kategori Jabatan -</option>
              <option value="Hakim">Hakim</option>
              <option value="Kepaniteraan">Kepaniteraan</option>
              <option value="Kesekretariatan">Kesekretariatan</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deksripsi Jabatan</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
          </div>
          <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" required readonly>
          </div>
          <div class="mb-3">
            <label for="is_atasan" class="form-label">Termasuk Atasan</label>
            <select class="form-select" id="is_atasan" name="is_atasan">
              <option value="1">Ya</option>
              <option value="0">Tidak</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="simpanJabatan">Simpan</button>
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
      $('#jabatanTable').DataTable({
        "pageLength": 25,
        "ordering": false, // Menonaktifkan fitur pengurutan (sort)
        "language": {
          "searchPlaceholder": "NIP / Nama" // Menambahkan placeholder pada input search
        }
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
  const formTambahJabatan = document.getElementById('formTambahJabatan');
  const simpanJabatanButton = document.getElementById('simpanJabatan');
  const namaJabatanInput = document.getElementById('nama_jabatan');
  const slugInput = document.getElementById('slug');

  // Event listener untuk menghasilkan slug otomatis
  namaJabatanInput.addEventListener('input', function() {
    const namaJabatan = namaJabatanInput.value;
    const slug = slugify(namaJabatan); // Panggil fungsi slugify untuk menghasilkan slug

    // Mengatur bidang "slug" dengan nilai slug yang dihasilkan
    slugInput.value = slug;
  });

  // Fungsi untuk menghasilkan slug dari string
  function slugify(text) {
    return text
      .toString()
      .toLowerCase()
      .trim()
      .replace(/\s+/g, '-') // Ganti spasi dengan tanda -
      .replace(/[^\w-]+/g, '') // Hapus karakter khusus
      .replace(/--+/g, '-'); // Ganti beberapa tanda - berturut-turut dengan satu tanda -
  }

  simpanJabatanButton.addEventListener('click', function() {
    // Mengambil data dari form
    const formData = new FormData(formTambahJabatan);

    // Kirim data ke server melalui Ajax
    $.ajax({
      method: 'POST',
      url: "{{ route('datamaster-jabatan-create')}}",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        // Handle respons dari server
        console.log(response);
        // Tutup modal
        $('#tambahJabatanModal').modal('hide');
        // Tampilkan pesan sukses menggunakan alert atau yang lainnya
        alert('Jabatan berhasil ditambahkan.');
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

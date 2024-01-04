@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Buat PKP
        </button>
        <a href="{{route('pengajuan-indikator-pkp')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Pengajuan Indikator PKP
        </a>
        <a href="{{route('pengajuan-indikator-pck')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Pengajuan Indikator PCK
        </a>
        <small class="text-muted float-end">Total: 1 PKP</small>
      </div>
      <div class="card-body">
        <h6 class="mb-4 text-muted">Klik Nama Lengkap untuk melihat data detail</h6>
        <table id="pegawaiTable" class="display">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Atasan Langsung</th>
              <th>Periode Tahun</th>
              <th>Tanggal Usulan</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($datas as $key)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td><a href="">{{$key->employee->nama}}</a></td>
              <td><a href="">{{$key->pejabatPenilai->nama}}</a></td>
              <td>{{ \Carbon\Carbon::parse($key->periode_mulai)->locale('id')->isoFormat('Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($key->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
              <td><span class="badge bg-success">PKP_DITERIMA</span></td>
              <td>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="orederStatistics"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="orederStatistics">
                    <a class="dropdown-item" href="javascript:void(0);">Download PKP</a>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
            <!-- Tambahkan baris data pegawai dan hakim lainnya di sini -->
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('tambah-pkp')}}" method="POST" id="tambah-pkp">
        @csrf
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Buat PKP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Periode Mulai</label>
            <input class="form-control" type="date" id="html5-date-input" name="periode_mulai"/>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Periode Selesai</label>
            <input class="form-control" type="date" id="html5-date-input" name="periode_selesai" />
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Pejabat Penilai Kinerja</label>
            <select class="form-select" id="searchable-dropdown" name="pejabat_penilai">
              <option value=""></option>
              @foreach($atasan as $key)
                <option value="{{$key->nip}}">{{$key->nip}} - {{$key->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Atasan Pejabat Penilai</label>
            <select class="form-select" id="searchable-dropdown2" name="atasan_pejabat_penilai">
              <option value=""></option>
              @foreach($atasan as $key)
                <option value="{{$key->nip}}">{{$key->nip}} - {{$key->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="konfirmasiInput()">Proses</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

@endsection
@section('page-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#pegawaiTable').DataTable({
        "ordering": false, // Menonaktifkan fitur pengurutan (sort)
        "language": {
          "searchPlaceholder": "Ketik di sini untuk mencari PKP berdasarkan Nama, Atasan Langsung, atau Periode." // Menambahkan placeholder pada input search
        }
      });
    });

    $(document).ready(function() {
    // Inisialisasi Select2 ketika modal terbuka
    $('#basicModal').on('shown.bs.modal', function () {
        $('#searchable-dropdown').select2({
            placeholder: "Pilih Pejabat Penilai Kerja",
            allowClear: true,
            dropdownParent: $("#basicModal") // Ini memastikan dropdown ditampilkan di atas modal
        });
        $('#searchable-dropdown2').select2({
            placeholder: "Pilih Atasan Pejabat Penilai",
            allowClear: true,
            dropdownParent: $("#basicModal") // Ini memastikan dropdown ditampilkan di atas modal
        });
    });
});

function konfirmasiInput() {
  swal({
    title: 'Konfirmasi',
    text: 'Data sudah benar?',
    type: 'warning', // SweetAlert 1.x menggunakan 'type' bukan 'icon'
    showCancelButton: true,
    confirmButtonColor: '#3085d6', // Anda bisa mengatur warna tombol jika diinginkan
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya',
    cancelButtonText: 'Tidak',
    closeOnConfirm: false, // Penting untuk diatur agar modal tidak langsung tertutup
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      // Pengguna mengklik 'Ya', submit form
      document.getElementById('tambah-pkp').submit();
    } else {
      // Pengguna mengklik 'Tidak', hanya tutup modal
      swal('Dibatalkan', 'Data tidak jadi disimpan :)', 'error');
    }
  });
}
  </script>

@endsection

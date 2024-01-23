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
            @foreach($data as $key)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$key->butir_kegiatan}}
                @if($key->status == 2)
                <br><span style="color:red">Alasan ditolak: salah</span>
                @else
                @endif
              </td>
              <td>{{$key->hasil}}</td>
              <td>{{$key->employee->nama}}<br>{{$key->employee->nip}}</td>
              <td>
                @if($key->status == 2)
                <span class="badge bg-danger">DITOLAK</span>
                @elseif($key->status == 1)
                <span class="badge bg-success">DISETUJUI</span>
                @else
                <span class="badge bg-info">MENUNGGU PERSETUJUAN</span>
                @endif
              </td>
              <td>{{ \Carbon\Carbon::parse($key->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
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
<div class="modal fade" id="indikatorModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="{{route('tambah-indikator-pck')}}" method="POST" id="tambah_indikator_pck">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Tambah Indikator Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Butir Kegiatan</label>
            <input class="form-control" type="text" name="butir_kegiatan" id="butirKegiatan"/>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Hasil</label>
            <select class="form-select" id="satuanHasil" aria-label="Default select example" name="hasil">
              <option value="">Pilih</option>
              @foreach($hasil as $key)
              <option value="{{$key}}">{{$key}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="konfirmasiInput()">Ajukan</button>
      </div>
    </form>
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
      document.getElementById('tambah_indikator_pck').submit();
    } else {
      // Pengguna mengklik 'Tidak', hanya tutup modal
      swal('Dibatalkan', 'Data tidak jadi disimpan :)', 'error');
    }
  });
}
  </script>
@endsection

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
              <th>Sasaran Kegiatan</th>
              <th>Indikator</th>
              <th>Pemohon</th>
              <th>Status</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $key)
            <tr>
              <td>1</td>
              <td>{{$key->sasaran_kegiatan->sasaran_kegiatan_text}}
                @if($key->status == 2)
                  <br><span style="color:red">Alasan ditolak: salah</span>
                @else

                @endif
              </td>
              <td>{{$key->indikator}}</td>
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
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Tambah Indikator Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="tambah_indikator_pkp" method="POST" action="{{route('tambah-indikator-pkp')}}">
            @csrf
            <div class="row">
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">Sasaran Kegiatan</label>
                <select class="form-select" id="sasaranKegiatan" name="sasaran_kegiatan_id" aria-label="Default select example">
                    <option value="{{old('sasaran_kegiatan_id')}}">Pilih</option>
                        @foreach($sasaran_kegiatan as $key)
                            <option value="{{ $key->id }}">{{ $key->sasaran_kegiatan_text }}</option>
                        @endforeach
                    <option value="lainnya">Lainnya</option>
                </select>
                <input class="form-control mt-3" style="display: none;" type="text" id="sasaranKegiatanBaru" name="sasaran_kegiatan_text"/>
            </div>
            </div>
            <div class="row">
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">Indikator</label>
                <input class="form-control" type="text" name="indikator" id="indikatorKegiatan"/>
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

    $(document).ready(function() {
        $('#sasaranKegiatan').change(function() {
            // Cek jika opsi yang dipilih adalah 'lainnya'
            if ($(this).val() == 'lainnya') {
                // Tampilkan field input untuk sasaran kegiatan baru
                $('#sasaranKegiatanBaru').show();
            } else {
                // Sembunyikan field jika opsi lain yang dipilih
                $('#sasaranKegiatanBaru').hide();
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
      document.getElementById('tambah_indikator_pkp').submit();
    } else {
      // Pengguna mengklik 'Tidak', hanya tutup modal
      swal('Dibatalkan', 'Data tidak jadi disimpan :)', 'error');
    }
  });
}

  </script>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">PKP PERIODE {{ \Carbon\Carbon::parse($data->periode_mulai)->locale('id')->isoFormat('D MMMM Y') }} S/D {{ \Carbon\Carbon::parse($data->periode_selesai)->locale('id')->isoFormat('D MMMM Y') }} (PKP_DITERIMA)</h5>
        <div>
          <a href="" type="button" class="btn btn-sm btn-secondary"><span class="tf-icons bx bx-arrow-back"></span> Kembali</a>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalPCK"><span class="tf-icons bx bx-plus"></span> Tambah PCK</button>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <tr>
            <th colspan="2">PEGAWAI YANG DINILAI</th>
            <th colspan="2">PEJABAT PENILAI KINERJA</th>
          </tr>
          <tr>
            <td>NAMA</td>
            <td>{{$data->employee->nama}}</td>
            <td>NAMA</td>
            <td>{{$atasan->pejabatPenilai->nama}}</td>
          </tr>
          <tr>
            <td>NIP</td>
            <td>{{$data->employee->nip}}</td>
            <td>NIP</td>
            <td>{{$atasan->pejabatPenilai->nip}}</td>
          </tr>
          <tr>
            <td>PANGKAT / GOL.</td>
            <td>{{$data->employee->golongan->pangkat}} - {{$data->employee->golongan->jenis_golongan}}</td>
            <td>PANGKAT / GOL.</td>
            <td>{{$atasan->pejabatPenilai->golongan->pangkat}} - {{$atasan->pejabatPenilai->golongan->jenis_golongan}}</td>
          </tr>
          <tr>
            <td>JABATAN</td>
            <td>{{$atasan->employee->department->nama_jabatan}}</td>
            <td>JABATAN</td>
            <td>{{$atasan->pejabatPenilai->department->nama_jabatan}}</td>
          </tr>
          {{-- <tr>
            <td>PENEMPATAN</td>
            <td>Subbagian Kepegawaian</td>
            <td>PENEMPATAN</td>
            <td>Subbagian Kepegawaian</td>
          </tr> --}}
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center">
        <h5>PERJANJIAN KERJA INDIVIDU</h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="tabelPKP">
          <thead>
            <tr>
                <th class="text-nowrap">NO</th>
                <th class="text-nowrap text-center">SASARAN KEGIATAN</th>
                <th class="text-nowrap text-center">SATUAN</th>
                <th class="text-nowrap text-center">INDIKATOR</th>
                <th class="text-nowrap text-center">TARGET KUANTITAS</th>
            </tr>
        </thead>
        <tbody>
          @foreach($perjanjian as $key)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>
                {{$key->sasaran_kegiatan}}
              </td>
              <td>
                {{$key->satuan}}
              </td>
              <td>
                {{$key->indikator}}
              </td>
              <td>
                {{$key->target_kuantitas}}
              </td>
              </td>
            </tr>
            @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center">
        <h5>PENILAIAN CAPAIAN KINERJA BULANAN</h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="tabelPKP">
          <thead>
            <tr>
                <th class="text-nowrap" width="10%">NO</th>
                <th class="text-nowrap text-center" width="60%">Laporan</th>
                <th class="text-nowrap text-center" width="20%">Status</th>
                <th class="text-nowrap text-center" width="10%"></th>
            </tr>
        </thead>
        <tbody>
          @php
            $namaBulan = [
              1 => 'Januari',
              2 => 'Februari',
              3 => 'Maret',
              4 => 'April',
              5 => 'Mei',
              6 => 'Juni',
              7 => 'Juli',
              8 => 'Agustus',
              9 => 'September',
              10 => 'Oktober',
              11 => 'November',
              12 => 'Desember'
            ];
          @endphp
          @foreach($capaian as $pck)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>PCK Periode {{$namaBulan[$pck->periode_pck->periode_bulan]}} {{$pck->periode_pck->periode_tahun}}</td>
            <td>
              @if($pck->status == 0)
              PCK_DRAFT
              @endif
              @if($pck->status == 1)
              PCK_BARU
              @endif
            </td>
            <td>
              <a href="" type="button" class="btn btn-sm btn-primary"><span class="tf-icon bx bx-info-circle"></span> Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPCK" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('simpan-periode-capaian')}}" method="POST" id="tambah-pck">
        @csrf
        @foreach($penilaian as $key)
        <input class="form-control" type="hidden" name="penilaian_kinerja_id" value="{{$key->id}}"/>
        @endforeach
        <input type="hidden" id="idTarget" value={{$data->id}} name="idTarget"/>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Tambah PCK</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Bulan</label>
            <select class="form-select" id="searchable-dropdown" name="periode_bulan">
              <option value="">Pilih Bulan</option>
              <option value="1">Januari</option>
              <option value="2">Februai</option>
              <option value="3">Maret</option>
              <option value="4">April</option>
              <option value="5">Mei</option>
              <option value="6">Juni</option>
              <option value="7">Juli</option>
              <option value="8">Agustus</option>
              <option value="9">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Tahun</label>
            <input class="form-control" type="text" id="html5-date-input" name="periode_tahun" value="{{ \Carbon\Carbon::now()->year }}" readonly/>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary col-12" onclick="konfirmasiInput()" data-iterasi="{{count($perjanjian)}}">Proses</button>
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
//     function konfirmasiInput() {
//   swal({
//     title: 'Konfirmasi',
//     text: 'Data sudah benar?',
//     type: 'warning', // SweetAlert 1.x menggunakan 'type' bukan 'icon'
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6', // Anda bisa mengatur warna tombol jika diinginkan
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'Ya',
//     cancelButtonText: 'Tidak',
//     closeOnConfirm: false, // Penting untuk diatur agar modal tidak langsung tertutup
//     closeOnCancel: false
//   }, function(isConfirm) {
//     if (isConfirm) {
//       // Pengguna mengklik 'Ya', submit form
//       document.getElementById('tambah-pck').submit();
//     } else {
//       // Pengguna mengklik 'Tidak', hanya tutup modal
//       swal('Dibatalkan', 'Data tidak jadi disimpan :)', 'error');
//     }
//   });
// }
function konfirmasiInput() {
  // var jumlahIterasi = {{ count($perjanjian) }};
  // var bulanTerpilih = $('#searchable-dropdown').val();
  // var tahunTerpilih = $('#html5-date-input').val();
  // var idTarget = $('#idTarget').val();
  // console.log(idTarget)

  // Mengatur data bulan dan tahun untuk setiap perjanjian
  // for (var i = 0; i < jumlahIterasi; i++) {
  //   $('#tambah-pck').append('<input type="hidden" name="periode_bulan[]" value="' + bulanTerpilih + '">');
  //   $('#tambah-pck').append('<input type="hidden" name="periode_tahun[]" value="' + tahunTerpilih + '">');
  // }

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
      // Submit form
  $('#tambah-pck').submit();
    } else {
      // Pengguna mengklik 'Tidak', hanya tutup modal
      swal('Dibatalkan', 'Data tidak jadi disimpan :)', 'error');
    }
  });


}


  </script>
@endsection

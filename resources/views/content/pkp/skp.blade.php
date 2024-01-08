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
                <th class="text-nowrap">NO</th>
                <th class="text-nowrap text-center">Laporan</th>
                <th class="text-nowrap text-center">Status</th>
                <th class="text-nowrap text-center"></th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPCK" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POST" id="tambah-pck">
        @csrf
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Tambah PCK</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Bulan</label>
            <select class="form-select" id="searchable-dropdown" name="bulan_pck">
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
            <input class="form-control" type="text" id="html5-date-input" name="tahun_pck" value="{{ \Carbon\Carbon::now()->year }}" readonly/>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary col-12" onclick="konfirmasiInput()">Proses</button>
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
  </script>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center">
        <h4>FORM PKP PERIODE {{ \Carbon\Carbon::parse($pkp->periode_mulai)->locale('id')->isoFormat('D MMMM Y') }} S/D {{ \Carbon\Carbon::parse($pkp->periode_selesai)->locale('id')->isoFormat('D MMMM Y') }}</h4>
      </div>
      <div class="card-body">
        <table id="pegawaiTable" class="display">
          <tr>
            <th colspan="2">PEGAWAI YANG DINILAI</th>
            <th colspan="2">PEJABAT PENILAI KINERJA</th>
          </tr>
          <tr>
            <td>NAMA</td>
            <td>{{$pkp->employee->nama}}</td>
            <td>NAMA</td>
            <td>{{$atasan->pejabatPenilai->nama}}</td>
          </tr>
          <tr>
            <td>NIP</td>
            <td>{{$pkp->employee->nip}}</td>
            <td>NIP</td>
            <td>{{$atasan->pejabatPenilai->nip}}</td>
          </tr>
          <tr>
            <td>PANGKAT / GOL.</td>
            <td>{{$pkp->employee->golongan->pangkat}} - {{$pkp->employee->golongan->jenis_golongan}}</td>
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
        <h4>PERJANJIAN KERJA INDIVIDU</h4>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
                <th class="text-nowrap">NO</th>
                <th class="text-nowrap text-center">SASARAN KEGIATAN</th>
                <th class="text-nowrap text-center">SATUAN</th>
                <th class="text-nowrap text-center">INDIKATOR</th>
                <th class="text-nowrap text-center">TARGET KUANTITAS</th>
                <th class="text-nowrap text-center"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>1</td>
              <td>
                <select class="form-select" id="sasaranKegiatan" name="sasaran_kegiatan_id" aria-label="Default select example">
                <option value="{{old('sasaran_kegiatan_id')}}">Pilih</option>
                    @foreach($sasaran_kegiatan as $key)
                        <option value="{{ $key->id }}">{{ $key->sasaran_kegiatan_text }}</option>
                    @endforeach
                <option value="lainnya">Lainnya</option>
                </select>
              </td>
            <td>
              <select class="form-select" name="" id="">
                <option value="">Dokumen</option>
                <option value="">Laporan</option>
              </select>
            </td>
            <td>
              <select class="form-select" id="sasaranKegiatan" name="sasaran_kegiatan_id" aria-label="Default select example">
                <option value="{{old('sasaran_kegiatan_id')}}">Pilih</option>
                    @foreach($indikator as $key)
                        <option value="{{ $key->id }}">{{ $key->indikator }}</option>
                    @endforeach
              </select>
            </td>
            <td>
              <input class="form-control" type="text" name="indikator" id="indikatorKegiatan"/>
            </td>
            <td></td>
            </tr>
            <tr>
              <td colspan="6">
                <a href="" type="button" class="btn btn-secondary col-xl-12">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah
              </a>
              </td>
            </tr>
        </tbody>
        </table>
        <a href="" type="button" class="btn btn-primary float-end mt-4">
          <span class="tf-icons bx bx-send"></span>&nbsp; Ajukan
        </a>
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

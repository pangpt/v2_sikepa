@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
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
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">PCK Periode: {{$namaBulan[$pck->periode_pck->periode_bulan]}} {{$pck->periode_pck->periode_tahun}} (PKP_DRAFT)</h5>
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
      <div class="card-header justify-content-between align-items-center m-0">
        <h5>DAFTAR INDIKATOR KINERJA</h5>
      </div>
      @foreach($perjanjian as $indikator)

      <div class="card-header pt-0">
        <small class="fw-bold">Indikator Kinerja: {{$indikator->indikator}}</small> <br>
        <small class="fw-bold"><span class="tf-icon bx bx-info-circle"></span> Keterangan: Jika nilai Kualitas dan Kuantitas sama dengan 0 maka data tidak akan tersimpan pada sistem</small>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="{{$indikator->id}}" data-indikator-id="{{ $indikator->id }}">
          <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2" style="width: 40%">Kegiatan Tugas Jabatan</th>
                <th colspan="3" class="text-center" style="width: 10%">Target</th>
                <th colspan="3" class="text-center" style="width: 10%">Realisasi</th>
                <th rowspan="2">Nilai Capaian Kinerja</th>
                <th rowspan="2"></th>
            </tr>
            <tr>
                <!-- Kolom untuk detail target -->
                <th>Kuant/Output</th>
                <th>Satuan</th>
                <th>Kual/Mutu</th>
                <!-- Kolom untuk detail realisasi -->
                <th>Kuant/Output</th>
                <th>Satuan</th>
                <th>Kual/Mutu</th>
            </tr>
        </thead>
        <tbody>
          @foreach($indikator->capaian_kinerja as $key)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <select class="form-select butir-kegiatan-select">
                      @foreach($indikator_pck as $item)
                        <option value="{{$item->id}}"{{ $key->indikator_pck_id == $item->id ? 'selected' : '' }}>{{$item->butir_kegiatan}}</option>
                      @endforeach
                    </select>
                </td>
                <!-- Data target -->
                <td><input type="number" class="form-control" name="target_kuantitas" value="{{$key->target_output}}"></td>
                <td class="hasil-input"></td>
                <td><input type="number" class="form-control" name="target_kualitas" value="{{$key->target_mutu}}"></td>
                <!-- Data realisasi -->
                <td><input type="number" class="form-control" name="realisasi_kuantitas" value="{{$key->realisasi_output}}"></td>
                <td class="hasil-input"></td>
                <td><input type="number" class="form-control" name="realisasi_kualitas" value="{{$key->realisasi_mutu}}"></td>
                <!-- Nilai capaian kinerja -->
                <td></td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEviden"><span class="tf-icon bx bx-link"></span></button>
                    <button class="btn btn-danger btn-sm hapusBaris"><span class="tf-icon bx bx-trash"></i></button>
                </td>
            </tr>
            @endforeach
            <tr class="tambah-row">
              <td colspan="10">
                {{-- <button class="btn btn-primary col-xl-12 tambah-baris"  type="button" data-table="{{ $indikator->id }}" > --}}
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah
                </button>
              </td>
            </tr>
            <tr>
              <td colspan="8" class="text-center">
                Nilai Capaian Kinerja
              </td>
              <td colspan="2">
                0.0
              </td>
            </tr>
        </tbody>
        </table>
      </div>
      @endforeach
      <div class="card-footer justify-right">
        <button type="button" class="btn btn-sm btn-secondary"><span class="tf-icon bx bx-arrow-back"></span>Batal</button>
        <button type="button" class="btn btn-sm btn-info" id="tombolSimpan"><span class="tf-icon bx bx-save"></span>Simpan</button>
        <button type="button" class="btn btn-sm btn-primary" id="tombolAjukan"><span class="tf-icon bx bx-send"></span>Ajukan</button>
      </div>

    </div>
  </div>
</div>


@endsection
@section('page-script')


<script>
  $(document).ready(function() {
     $(document).on('change', '.butir-kegiatan-select', function() {
        // Temukan satuan yang terkait dengan opsi yang dipilih
        var hasil = $(this).find('option:selected').data('hasil');
        console.log(hasil)

        // Mengisi input 'hasil' yang sejajar dengan dropdown ini
        $(this).closest('tr').find('.hasil-input').text(hasil);
    });
});
</script>
@endsection

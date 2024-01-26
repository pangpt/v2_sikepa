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
        <div>
          <a href="" type="button" class="btn btn-sm btn-secondary"><span class="tf-icons bx bx-arrow-back"></span> Kembali</a>
          <a href="{{route('download-pck',['id' => $pck->id])}}" type="button" target="_blank" class="btn btn-sm btn-primary"><span class="tf-icons bx bx-download"></span> Download</a>
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
           @php
            $totalNilaiCapaian = 0;
            $jumlahData = count($indikator->capaian_kinerja);
          @endphp
          @foreach($indikator->capaian_kinerja as $key)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$key->indikator_pck->butir_kegiatan}}
                </td>
                <!-- Data target -->
                <td>{{$key->target_output}}</td>
                <td>{{$key->indikator_pck->hasil}}</td>
                <td>{{$key->target_mutu}}</td>
                <!-- Data realisasi -->
                <td>{{$key->realisasi_output}}</td>
                <td>{{$key->indikator_pck->hasil}}</td>
                <td>{{$key->realisasi_mutu}}</td>
                <td class="nilai-capaian">{{$key->nilai_capaian}}</td>
                @php
                  $totalNilaiCapaian += $key->nilai_capaian;
                @endphp
            </tr>
            @endforeach
            <tr>
              <td colspan="8" class="text-center">
                Nilai Capaian Kinerja
              </td>
              <td colspan="2">
                @if($jumlahData > 0)
                  {{ number_format($totalNilaiCapaian / $jumlahData, 2) }}
                @else
                  0.00
                @endif
              </td>
            </tr>
        </tbody>
        </table>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center m-0">
        <h5>REKAPITULASI PENILAIAN CAPAIAN KINERJA BULAN </h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
                <th>No</th>
                <th style="width: 70%">Kegiatan Tugas Jabatan</th>
                <th>Nilai Capaian Kinerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penilaian_total as $indikator)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$indikator->indikator}}
                </td>
                <td class="nilai-capaian">
                  @if($indikator->capaian_kinerja)
                  @php
                      // Mengurai JSON untuk mendapatkan array
                      $capaianData = json_decode($indikator->capaian_kinerja, true);
                      // Menampilkan total nilai capaian dari array
                      $totalNilaiCapaian = $capaianData[0]['total_nilai_capaian'] ?? 0;
                  @endphp
                  {{ number_format($totalNilaiCapaian, 2) }}
              @else
                  0
              @endif
                </td>
            </tr>
            @endforeach
            <tr>
              <td colspan="2" class="text-center">
                Hasil Capaian Kinerja Bulan
              </td>
              <td>
                {{$pck->total_capaian}}
              </td>
            </tr>
        </tbody>
        </table>
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
    // Fungsi untuk menghitung rata-rata
    function calculateAverage() {
        var total = 0;
        var count = 0;

        // Melakukan iterasi melalui semua nilai dalam kolom 'nilai capaian kinerja'
        $(".nilai-capaian").each(function() {
            // Menambahkan nilai ke total
            total += parseFloat($(this).text()) || 0;
            count++;
        });

        // Menghitung rata-rata
        var average = total / count;

        // Memastikan hasil tidak NaN atau Infinity akibat pembagian dengan nol
        average = isFinite(average) ? average : 0;

        // Menampilkan rata-rata pada kolom 'Nilai Capaian Kinerja'
        $("#nilai-rata-rata").text(average.toFixed(2));
    }

    // Memanggil fungsi ketika dokumen siap
    calculateAverage();
});
</script>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Capaian Kinerja Bulanan</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 10pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px; /* Atau ukuran lain yang lebih sesuai */
        }
        table, th, td {
          padding: 2px; /* Sesuaikan dengan yang Anda butuhkan */
        }

        th, td {
            border: 1px solid black;
            padding: 2px;
            width: auto; /* Atau nilai spesifik jika Anda ingin mengatur lebar tertentu */
        }
        th {
            background-color: #f2f2f2;
        }
        .header-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-section h1 {
            margin: 0;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .signature {
            margin-top: 50px;
        }
    </style>
</head>
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
<body>
    <div class="header-section">
        <h3>FORMULIR PENILAIAN CAPAIAN KINERJA BULANAN</h3>
        <H3>PEGAWAI NEGERI SIPIL PENGADILAN AGAMA WATAMPONE</H3>
    </div>

    <p>Bulan: {{$namaBulan[$pck->periode_pck->periode_bulan]}} {{$pck->periode_pck->periode_tahun}}</p>
    <!-- Informasi Pegawai -->
    <table class="table">
      <tr>
        <th colspan="2">PEGAWAI YANG DINILAI</th>
        <th colspan="2">PEJABAT PENILAI KINERJA</th>
      </tr>
      <tr>
        <td>NAMA</td>
        <td>{{$datadiri->employee->nama}}</td>
        <td>NAMA</td>
        <td>{{$atasan->pejabatPenilai->nama}}</td>
      </tr>
      <tr>
        <td>NIP</td>
        <td>{{$datadiri->employee->nip}}</td>
        <td>NIP</td>
        <td>{{$atasan->pejabatPenilai->nip}}</td>
      </tr>
      <tr>
        <td>PANGKAT / GOL.</td>
        <td>{{$datadiri->employee->golongan->pangkat}} - {{$datadiri->employee->golongan->jenis_golongan}}</td>
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

    @foreach($perjanjian as $indikator)

      <div class="card-header pt-0">
        <small class="fw-bold">Indikator Kinerja: {{$indikator->indikator}}</small> <br>
      </div>

      <table class="table">
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
                <th>Output</th>
                <th>Satuan</th>
                <th>Mutu</th>
                <!-- Kolom untuk detail realisasi -->
                <th>Output</th>
                <th>Satuan</th>
                <th>Mutu</th>
            </tr>
        </thead>
        <tbody>
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
                <td>{{$key->nilai_capaian}}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="8" class="text-center">
                Nilai Capaian Kinerja
              </td>
              <td>
                {{ number_format($cektotal, 2) }}
              </td>
            </tr>
        </tbody>
        </table>
      @endforeach

      <table class="table">
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
              Hasil Capaian Kinerja Bulan {{$namaBulan[$pck->periode_pck->periode_bulan]}} {{$pck->periode_pck->periode_tahun}}
            </td>
            <td id="nilai-rata-rata">
              0.0
            </td>
          </tr>
      </tbody>
      </table>
      <table border="1" style="width: 100%; border-collapse: collapse;">
        <tr>
          <th style="width: 50%; text-align: center;">Pejabat Penilai</th>
          <th style="width: 50%; text-align: center;">PNS yang dinilai</th>
        </tr>
        <tr>
          <td style="text-align: center;">
            <p></p>
            <img style="margin:0" src="data:image/png;base64,{{ base64_encode($signatureQR) }}" alt="QR Code">
            <p>{{$atasan->pejabatPenilai->nama}}</p>
          </td>
          <td style="text-align: center;">
            <p></p>
            <img style="margin:0" src="data:image/png;base64,{{ base64_encode($signatureQR) }}" alt="QR Code">
            <p>{{$datadiri->employee->nama}}</p>
          </td>
        </tr>
      </table>

    <!-- Bagian Tanda Tangan -->
    <div class="signature">
        <table>

        </table>
    </div>
</body>
</html>

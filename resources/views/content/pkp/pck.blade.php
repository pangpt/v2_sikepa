@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">PCK BULAN: {{ \Carbon\Carbon::parse($data->periode_mulai)->locale('id')->isoFormat('D MMMM Y') }} S/D {{ \Carbon\Carbon::parse($data->periode_selesai)->locale('id')->isoFormat('D MMMM Y') }} (PKP_DITERIMA)</h5>
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
      <div class="card-header d-flex justify-content-between align-items-center">
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
            <tr class="tambah-row">
              <td colspan="10">
                <button class="btn btn-primary col-xl-12 tambah-baris"  type="button" data-table="{{ $indikator->id }}" >
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

      <div class="row">
        <div class="col-xl-12">
          <div class="card mb-4">
            <div class="card-body">
              <table class="table table-total">
                <thead>
                  <tr>
                      <th style="width:80%">Hasil Nilai Capaian Kinerja</th>
                      <th id="hasil-nilai-capaian-kinerja">0.00</th>
                  </tr>
              </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer justify-right">
        <button type="button" class="btn btn-sm btn-secondary"><span class="tf-icon bx bx-arrow-back"></span>Batal</button>
        <button type="button" class="btn btn-sm btn-info" id="tombolSimpan"><span class="tf-icon bx bx-save"></span>Simpan</button>
        <button type="button" class="btn btn-sm btn-primary" id="tombolAjukan"><span class="tf-icon bx bx-send"></span>Ajukan</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modalEviden" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="" method="POST" id="tambah-pck">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Bukti Dukung</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <textarea class="form-control" rows="3" id="inputBuktiDukung" name="bukti_dukung"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary col-12" id="tombolProses">Proses</button>
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
    // Gunakan class bukan id untuk event handler karena kita memiliki banyak tombol tambah
    $(".tambah-baris").click(function() {
        var tableId = $(this).data('table'); // Mengambil ID tabel dari tombol yang diklik
        console.log(tableId)
        var nomorBaru = $("#" + tableId + " tbody tr").not('.tambah-row, .nilai-capaian-kinerja').length;

        // Buat baris baru dengan menggunakan nomor baru dan tambahkan ke tabel yang sesuai
        var barisBaru = `<tr>
                <td>${nomorBaru}</td>
                <td>
                    <select class="form-select butir-kegiatan-select" name="indikator_pck_id[${tableId}][]">
                      <option value="">Pilih butir kegiatan</option>
                      @foreach($indikator_pck as $key)
                        <option value="{{$key->id}}" data-hasil="{{ $key->hasil }}">{{$key->butir_kegiatan}}</option>
                      @endforeach
                    </select>
                </td>
                <!-- Data target -->
                <input type="hidden" class="form-control periode_pck_id" name="periode_pck_id[${tableId}][]" value="{{session('periodeId')}}">
                <input type="hidden" class="form-control penilaian_kinerja_id" name="penilaian_kinerja_id[${tableId}][]" value="{{$data->id}}">
                <td><input type="text" class="form-control target-kuant-input" name="target_kuantitas[${tableId}][]"></td>
                <td><div class="hasil-input" name=""></div></td>
                <td><input type="text" class="form-control target-kual-input" name="target_kualitas[${tableId}][]" value="100"></td>
                <!-- Data realisasi -->
                <td><input type="text" class="form-control realisasi-kuant-input" name="realisasi_kuantitas[${tableId}][]"></td>
                <td><div class="hasil-input"></div></td>
                <td><input type="text" class="form-control realisasi-kual-input" name="realisasi_kualitas[${tableId}][]" ></td>
                <!-- Nilai capaian kinerja -->
                <td class="nilai-capaian"></td>
                <td>
                    <a href="#" type="button" class="btn btn-danger btn-sm hapusBaris"><span class="tf-icon bx bx-trash"></span></a>
                </td>
            </tr>`;

        $("#" + tableId + " tbody tr.tambah-row").before(barisBaru);
    });

    // Fungsi untuk menghapus baris
    $(document).on('click', '.hapusBaris', function(event) {
        event.preventDefault(); // Mencegah browser scroll ke atas
        $(this).closest('tr').remove();
    });

  });
$(document).ready(function() {
     $(document).on('change', '.butir-kegiatan-select', function() {
        // Temukan satuan yang terkait dengan opsi yang dipilih
        var hasil = $(this).find('option:selected').data('hasil');
        console.log(hasil)

        // Mengisi input 'hasil' yang sejajar dengan dropdown ini
        $(this).closest('tr').find('.hasil-input').text(hasil);
    });
});

var globalTotalAverage = 0;

function calculateAndDisplayAverages() {
  var totalAverage = 0;
  var tableCount = 0;
  var overallTotal = 0;

  $('.table-bordered').each(function() {
    var tableTotal = 0;
    var rowCount = 0;
    $(this).find('.nilai-capaian').each(function() {
      var value = parseFloat($(this).text()) || 0;
      tableTotal += value;
      rowCount++;
    });

    if (rowCount > 0) {
      var tableAverage = tableTotal / rowCount;
      $(this).closest('.card-body').find('.nilai-capaian-kinerja').text(tableAverage.toFixed(2));
      overallTotal += tableAverage;
      tableCount++;
    }
  });

  if (tableCount > 0) {
    totalAverage = overallTotal / tableCount;
    $('#hasil-nilai-capaian-kinerja').text(totalAverage.toFixed(2));
    globalTotalAverage = totalAverage;
  }

  return globalTotalAverage;
}


$(document).on('input', '.realisasi-kuant-input, .target-kuant-input', function() {
    var $row = $(this).closest('tr'); // Ambil baris terdekat dari input yang berubah
    var targetKuantOutput = parseFloat($row.find('.target-kuant-input').val()) || 0; // Ambil nilai target
    var realisasiKuantOutput = parseFloat($row.find('.realisasi-kuant-input').val()) || 0; // Ambil nilai realisasi

    // Hitung nilai kualitas/mutu
    var kualMutu = (targetKuantOutput !== 0) ? (realisasiKuantOutput / targetKuantOutput) * 100 : 0;

    // Set nilai kualitas/mutu ke dalam input realisasi-kual-input
    console.log(targetKuantOutput)
    $row.find('.realisasi-kual-input').val(kualMutu.toFixed(2));

    $row.find('.nilai-capaian').text(kualMutu.toFixed(2));

    calculateAndDisplayAverages();

});

calculateAndDisplayAverages();

function kumpulkanDanKirimData(status) {
  var semuaData = [];
  var rataRataPerTabel = [];
  var rataRataTotal = 0; // Deklarasi di sini

  // Loop melalui setiap tabel indikator
  $('.table-bordered').each(function() {
    var idTabel = this.id;
    var dataPerTabel = { id: idTabel, capaian: [], status: status };
    var rataRataTotal = calculateAndDisplayAverages();
    var jumlahBaris = 0;
    // var rataRataTotal = calculateAndDisplayAverages();


    // Loop melalui setiap baris pada tabel ini kecuali baris tambahan
    $('#' + idTabel + ' tbody tr').not('.tambah-row, .nilai-capaian-kinerja').each(function() {
      // var barisId = $('#modalEviden').attr('baris-id');


      var dataBaris = {
        kegiatan: $(this).find('select').val(),
        target_kuantitas: $(this).find('[name^="target_kuantitas"]').val(),
        target_kualitas: $(this).find('[name^="target_kualitas"]').val(),
        realisasi_kuantitas: $(this).find('[name^="realisasi_kuantitas"]').val(),
        realisasi_kualitas: $(this).find('[name^="realisasi_kualitas"]').val(),
        nilai_capaian: $(this).find('[name^="realisasi_kualitas"]').val(),
        periode_pck_id: $(this).find('[name^="periode_pck_id"]').val(),
        penilaian_kinerja_id: $(this).find('[name^="penilaian_kinerja_id"]').val(),
      };
      dataPerTabel.capaian.push(dataBaris);
      var rataRataTabel = calculateAndDisplayAverages();
      rataRataPerTabel.push(rataRataTabel);
    });

    semuaData.push(dataPerTabel);
    console.log(semuaData);
  });

  // Hitung rata-rata dari semua tabel
  if (rataRataPerTabel.length > 0) {
    rataRataTotal = rataRataPerTabel.reduce((acc, cur) => acc + cur, 0) / rataRataPerTabel.length;
  }

  // Konversi rata-rata total ke fixed dua desimal
  rataRataTotal = rataRataTotal.toFixed(2);
  // console.log('Rata-rata total dari semua tabel:', rataRataTotal);

  // AJAX call untuk mengirim data ke server
  $.ajax({
    url: '{{route("simpan-capaian")}}',
    type: 'POST',
    contentType: 'application/json',
    // data: JSON.stringify(semuaData),
    data: JSON.stringify({ data: semuaData, rataRataTotal: rataRataTotal }),
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      if(response.redirectUrl) {
          // Redirect ke URL yang diberikan oleh server
          window.location.href = response.redirectUrl;
      } else {
          // Tampilkan pesan sukses atau lakukan aksi lain
          alert('Data berhasil disimpan');
      }
  },
    error: function(error) {
      alert('Terjadi kesalahan saat menyimpan data');
      // tambahkan handler untuk error
    }
  });
}



$('#tombolSimpan').click(function() {
    kumpulkanDanKirimData(0); // Untuk "Simpan" statusnya 0
});

$('#tombolAjukan').click(function() {
    kumpulkanDanKirimData(1); // Untuk "Ajukan" statusnya 1
});

  </script>
@endsection

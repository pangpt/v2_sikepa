@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>


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
                    <select class="form-select">
                      @foreach($indikator_pck as $key)
                        <option value=""></option>
                        <option value="{{$key->id}}">{{$key->butir_kegiatan}}</option>
                      @endforeach
                    </select>
                </td>
                <!-- Data target -->
                <td><input type="number" class="form-control" name="target_kuantitas"></td>
                <td></td>
                <td><input type="number" class="form-control" name="target_kualitas"></td>
                <!-- Data realisasi -->
                <td><input type="number" class="form-control" name="realisasi_kuantitas"></td>
                <td></td>
                <td><input type="number" class="form-control" name="realisasi_kualitas"></td>
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
      <div class="card-footer justify-right">
        <button type="button" class="btn btn-sm btn-secondary"><span class="tf-icon bx bx-arrow-back"></span>Batal</button>
        <button type="button" class="btn btn-sm btn-info" id="tombolSimpan"><span class="tf-icon bx bx-save"></span>Simpan</button>
        <button type="button" class="btn btn-sm btn-primary"><span class="tf-icon bx bx-send"></span>Ajukan</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modalEviden" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
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
            <textarea class="form-control" name="roleExplanation" rows="3"></textarea>
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
                  <button class="btn btn-primary btn-sm link-btn" data-bs-toggle="modal" data-bs-target="#modalEviden"><span class="tf-icon bx bx-link"></span></button>
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
});

$('#tombolSimpan').click(function() {
  var semuaData = [];

  // Loop melalui setiap tabel indikator
  $('.table-bordered').each(function() {
    var idTabel = this.id;
    var dataPerTabel = { id: idTabel, capaian: [] };


    // Loop melalui setiap baris pada tabel ini kecuali baris tambahan
    $('#' + idTabel + ' tbody tr').not('.tambah-row, .nilai-capaian-kinerja').each(function() {
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
    });

    semuaData.push(dataPerTabel);
    console.log(semuaData);
  });

  // AJAX call untuk mengirim data ke server
  $.ajax({
    url: '{{route("simpan-capaian")}}',
    type: 'POST',
    contentType: 'application/json',
    // data: JSON.stringify(semuaData),
    data: JSON.stringify({ data: semuaData }),
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
});








  </script>
@endsection

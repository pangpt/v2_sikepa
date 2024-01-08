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
      <div class="card-header justify-content-between align-items-center m-0">
        <h5>DAFTAR INDIKATOR KINERJA</h5>
      </div>
      @foreach($perjanjian as $indikator)
      <div class="card-header pt-0">
        <small class="fw-bold">Indikator Kinerja: {{$indikator->indikator}}</small> <br>
        <small class="fw-bold"><span class="tf-icon bx bx-info-circle"></span> Keterangan: Jika nilai Kualitas dan Kuantitas sama dengan 0 maka data tidak akan tersimpan pada sistem</small>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="tabelPCK-{{ $indikator->id }}">
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
                    <button class="btn btn-primary btn-sm"><span class="tf-icon bx bx-link"></span></button>
                    <button class="btn btn-danger btn-sm hapusBaris"><span class="tf-icon bx bx-trash"></i></button>
                </td>
            </tr>
            @endforeach
            <tr class="tambah-row">
              <td colspan="10">
                <button class="btn btn-primary col-xl-12 tambah-baris"  type="button" data-table="tabelPCK-{{ $indikator->id }}">
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
        <button type="button" class="btn btn-secondary">Batalkan</button>
        <button type="button" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-success">Ajukan</button>
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
        "ordering": false,
        "language": {
          "searchPlaceholder": "Ketik di sini untuk mencari PKP berdasarkan Nama, Atasan Langsung, atau Periode." // Menambahkan placeholder pada input search
        }
      });
    });

    $(document).ready(function() {
    // Gunakan class bukan id untuk event handler karena kita memiliki banyak tombol tambah
    $(".tambah-baris").click(function() {
        var tableId = $(this).data('table'); // Mengambil ID tabel dari tombol yang diklik
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
                <td><input type="text" class="form-control target-kuant-input" name="target_kuantitas[${tableId}][]"></td>
                <td><div class="hasil-input"></div></td>
                <td><input type="text" class="form-control target-kual-input" name="target_kualitas[${tableId}][]" value="100"></td>
                <!-- Data realisasi -->
                <td><input type="text" class="form-control realisasi-kuant-input" name="realisasi_kuantitas[${tableId}][]"></td>
                <td><div class="hasil-input"></div></td>
                <td><input type="text" class="form-control realisasi-kual-input" name="realisasi_kualitas[${tableId}][]" ></td>
                <!-- Nilai capaian kinerja -->
                <td class="nilai-capaian"></td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm link-btn"><span class="tf-icon bx bx-link"></span></button>
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
    $row.find('.realisasi-kual-input').val(kualMutu.toFixed(2));

    $row.find('.nilai-capaian').text(kualMutu.toFixed(2));
});




  </script>
@endsection

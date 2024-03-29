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
        <table class="table">
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
      <form action="{{route('tambah-perjanjian')}}" method="POST">
        @csrf
      <div class="card-body">
        <table class="table table-bordered" id="tabelPKP">
          <thead>
            <tr>
                <th class="text-nowrap">NO</th>
                <th class="text-nowrap text-center">SASARAN KEGIATAN</th>
                <th class="text-nowrap text-center">SATUAN</th>
                <th class="text-nowrap text-center">INDIKATOR</th>
                {{-- <th class="text-nowrap text-center">TARGET KUANTITAS</th> --}}
                <th class="text-nowrap text-center"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <input class="form-control" type="hidden" name="penilaian_kinerja_id[]" value="{{$pkp->id}}" id="indikatorKegiatan"/>
              <td>1</td>
              <td>
                <select class="form-select" id="sasaranKegiatan" name="sasaran_kegiatan[]" aria-label="Default select example">
                <option value="{{old('sasaran_kegiatan')}}">Pilih</option>
                    @foreach($sasaran_kegiatan as $key)
                        <option value="{{ $key->sasaran_kegiatan_text }}">{{ $key->sasaran_kegiatan_text }}</option>
                    @endforeach
                {{-- <option value="lainnya">Lainnya</option> --}}
                </select>
              </td>
            <td>
              <select class="form-select" name="satuan[]" id="">
                <option value="Dokumen">Dokumen</option>
                <option value="Laporan">Laporan</option>
              </select>
            </td>
            <td>
              <select class="form-select" id="sasaranKegiatan" name="indikator[]" aria-label="Default select example">
                <option value="{{old('indikator')}}">Pilih</option>
                    @foreach($indikator as $key)
                        <option value="{{ $key->indikator }}">{{ $key->indikator }}</option>
                    @endforeach
              </select>
            </td>
            <td>
              <input class="form-control" type="hidden" name="target_kuantitas[]" id="indikatorKegiatan" value="0"/>
            </td>
            <td>
              <button class="btn btn-danger hapusBaris"><i class="bx bx-trash"></i></button>
            </td>
            </tr>
            <tr>
              <td colspan="6">
                <button class="btn btn-secondary col-xl-12" id="tambahBaris" type="button">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah
                </button>
              </td>
            </tr>
        </tbody>
        </table>
        <button type="submit" class="btn btn-primary float-end mt-4">
          <span class="tf-icons bx bx-send"></span>&nbsp; Ajukan
        </button>
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
    $("#tambahBaris").click(function() {
        var nomorBaru = $("#tabelPKP tbody tr").length; // Menghitung jumlah baris untuk nomor urut
        var barisBaru = `<tr>
          <input class="form-control" type="hidden" name="penilaian_kinerja_id[]" value="{{$pkp->id}}" id="indikatorKegiatan"/>
                <td>` + nomorBaru + `</td>
                <td>
                    <select class="form-select" name="sasaran_kegiatan[]">
                        <option>Pilih</option>
                        @foreach($sasaran_kegiatan as $key)
                            <option value="{{ $key->sasaran_kegiatan_text }}">{{ $key->sasaran_kegiatan_text }}</option>
                        @endforeach
                        <option value="lainnya">Lainnya</option>
                    </select>
                </td>
                <td>
                    <select class="form-select" name="satuan[]">
                        <option value="Dokumen">Dokumen</option>
                        <option value="Laporan">Laporan</option>
                    </select>
                </td>
                <td>
                    <select class="form-select" name="indikator[]">
                        <option>Pilih</option>
                        @foreach($indikator as $key)
                            <option value="{{ $key->indikator }}">{{ $key->indikator }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input class="form-control" type="hidden" name="target_kuantitas[]"value="0"/>
                </td>
                <td>
                    <button class="btn btn-danger hapusBaris"><i class="bx bx-trash"></i></button>
                </td>
            </tr>`;

        // Tambahkan baris baru ke akhir tabel
        // Menambahkan baris baru sebelum baris tombol tambah
        $(barisBaru).insertBefore("#tabelPKP tbody tr:last");
        updateRowNumbers();
        // $("#tabelPKP tbody").append(barisBaru);
    });

    // Fungsi untuk menghapus baris
    $(document).on('click', '.hapusBaris', function() {
        $(this).closest('tr').remove();
        updateRowNumbers();
    });

    // Fungsi untuk memperbarui nomor baris
    function updateRowNumbers() {
        $("#tabelPKP tbody tr:not(:last)").each(function(index) {
            $(this).find("td:first").text(index + 1);
        });
    }
});
  </script>
@endsection

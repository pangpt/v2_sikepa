@extends('layouts/contentNavbarLayout')

@section('title', ' Horizontal Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Horizontal Layouts</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-12">
    <div class="nav-align-top mb-4">
      <div class="tab-content">
        <div class="card-header justify-content-between align-items-center">
        <a href="{{route('layanan-izin-cuti-index')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-left-arrow-alt"></span>
        </a>
        <a href="{{route('izin-cuti-penangguhan')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Ajukan Penangguhan
        </a>
      </div>
        <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Catatan Cuti</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-nowrap">Cuti</th>
                    <th class="text-nowrap text-center">Tahun</th>
                    <th class="text-nowrap text-center">Sisa</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $tahunSekarang = date("Y");
                  $tahunSebelumnya2 = $tahunSekarang - 2;
                  @endphp

                  @for ($tahun = $tahunSebelumnya2; $tahun <= $tahunSekarang; $tahun++)
                  <tr>
                      <td class="text-nowrap">Tahunan</td>
                      <td>
                          {{ $tahun }}
                      </td>
                      <td class="text-nowrap">
                          @foreach ($leave_employee as $cuti)
                              @if ($cuti->tahun == $tahun)
                                  {{ $cuti->jumlah_cuti ?? 0}}
                              @endif
                          @endforeach
                      </td>
                  </tr>
                  @endfor
              </tbody>
              </table>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Form Permohonan Cuti</h5>
            </div>
            <div class="card-body">
              <form action="{{route('izin-cuti-add')}}" id="formPengajuanCuti" method="POST">
                @csrf
                <input type="hidden" id="sisa_cuti" data-sisa-cuti="{{@$leave_employee->first()->jumlah_cuti}}">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Jenis Cuti</label>
                  <div class="col-sm-10">
                    <select id="jenis_cuti" name="jenis_cuti" class="select2 form-select">
                      <option value="">Pilih -</option>
                      <option value="Cuti Tahunan">Cuti Tahunan</option>
                      <option value="Cuti Sakit">Cuti Sakit</option>
                      <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Alasan</label>
                  <div class="col-sm-10">
                    <textarea id="alasan" name="alasan" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-company">Periode</label>
                  <div class="col-sm-5">
                    <input class="form-control" type="date" name="periode_awal" placeholder="Mulai" id="periode_awal" />
                  </div>
                  <div class="col-sm-5">
                    <input class="form-control" type="date" name="periode_akhir" placeholder="Selesai" id="periode_akhir" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-company">Jumlah Hari</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="jumlah_hari" name="jumlah_hari" placeholder="" readonly="readonly"/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat Saat Cuti</label>
                  <div class="col-sm-10">
                    <textarea id="basic-default-message" name="alamat_cuti" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">No. Telp Saat Cuti</label>
                  <div class="col-sm-10">
                    <input type="text" id="basic-default-phone" name="phone_cuti" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Atasan Langsung</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control fw-bold" id="atasan" name="atasan" placeholder="{{$atasan->nama}}" readonly="readonly"/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Pejabat Berwenang</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control fw-bold" id="pimpinan" name="pimpinan" placeholder="{{@$pimpinan->nama}}" readonly="readonly"/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">Lampiran</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="lampiran" name="lampiran">
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js-after')
<script>
  document.addEventListener('DOMContentLoaded', function() {
        const tanggalMulaiInput = document.getElementById('periode_awal');
        const tanggalSelesaiInput = document.getElementById('periode_akhir');
        const jumlahHariInput = document.getElementById('jumlah_hari');

        tanggalMulaiInput.addEventListener('change', function() {
            updateJumlahHari();
        });

        tanggalSelesaiInput.addEventListener('change', function() {
            updateJumlahHari();
        });

        function updateJumlahHari() {
            const tanggalMulai = new Date(tanggalMulaiInput.value);
            const tanggalSelesai = new Date(tanggalSelesaiInput.value);
            const diffInTime = tanggalSelesai - tanggalMulai;
            const diffInDays = diffInTime / (1000 * 3600 * 24);
            jumlahHariInput.value = diffInDays + 1;
        }
    });

    $(document).ready(function() {
        // Ketika form dikirimkan
        $('#formPengajuanCuti').on('submit', function(e) {
            // Mendapatkan jumlah hari cuti yang diinputkan oleh user
            var jumlahHariCuti = parseInt($('#jumlah_hari').val());
            // Mendapatkan sisa cuti dari elemen yang menyimpan data tersebut
            var sisaCuti = parseInt($('#sisa_cuti').data('sisa-cuti')); // Pastikan elemen dengan id sisaCuti memiliki data attribute data-sisa-cuti

            // Cek jika jumlah hari cuti lebih dari sisa cuti
            if (jumlahHariCuti > sisaCuti) {
                e.preventDefault(); // Mencegah form dari pengiriman
                swal('Maaf','Pengajuan cuti tidak bisa melebihi sisa cuti tahunan','error'); // Tampilkan alert
            }
        });
    });


</script>
@endsection

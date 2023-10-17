<table class="table table-striped table-borderless border-bottom">
  @if(Auth::user()->role == 'kepegawaian')
  @if($izinCuti->status_permohonan == '2' && !$izinCuti->diverifikasi())
  <button type="button" class="btn btn-md btn-primary float-end" data-bs-toggle="modal" data-bs-target="#setujuiModal">Verifikasi Pengajuan</button>
  @endif
  @endif

  {{-- @if(@$izinCuti->atasan->department_id == Auth::user()->employee->department->id)
  <button class="btn btn-md btn-danger float-end">Tolak Pengajuan</button>
    <button class="btn btn-md btn-primary float-end">Setujui Pengajuan</button>
  @endif --}}

  {{-- @if(in_array(auth()->user()->role, ['ketua', 'admin', 'kepegawaian', 'sekretaris', 'panitera'])) --}}
  {{-- @if(auth()->user()->role != $izinCuti->atasan->nama) --}}
  {{-- @if({{App\Models\Leave_approval::where('status_approval', 4)->where('leave_id', $user)->count() > 0}}) --}}

  @if(in_array(auth()->user()->role, ['ketua', 'admin']))
  @if($izinCuti->status_permohonan == '0' && !$izinCuti->disetujuiKetua())
      <button type="button" class="btn btn-md btn-danger float-end" data-bs-toggle="modal" data-bs-target="#tolakModal">Tolak Pengajuan</button>
        <button type="button" class="btn btn-md btn-primary float-end" data-bs-toggle="modal" data-bs-target="#setujuiModal">Setujui Pengajuan</button>
  @endif
  @endif

  @if(in_array(auth()->user()->role, ['sekretaris', 'panitera']))
  @if($izinCuti->status_permohonan == '1' && !$izinCuti->disetujuiAtasanLangsung())
  <button type="button" class="btn btn-md btn-danger float-end" data-bs-toggle="modal" data-bs-target="#tolakModal">Tolak Pengajuan</button>
        <button type="button" class="btn btn-md btn-primary float-end" data-bs-toggle="modal" data-bs-target="#setujuiModal">Setujui Pengajuan</button>
      @endif
  @endif
{{--
  @if(auth()->user()->role == 'kepegawaian')
    @if(App\Models\Leave_approval::where('status_approval', 1)->where('leave_id', $user)->count() > 0 && App\Models\Leave_approval::where('status_approval', 2)->where('leave_id', $user)->count() > 0)
      <button type="button" class="btn btn-md btn-danger float-end" data-bs-toggle="modal" data-bs-target="#tolakModal">Tolak Pengajuan</button>
        <button type="button" class="btn btn-md btn-primary float-end" data-bs-toggle="modal" data-bs-target="#setujuiModal">Setujui Pengajuan</button>
      @endif
  @endif --}}

  @if($izinCuti->status_permohonan == '3')
    <a href="{{route('izin-cuti-generate', ['id' => $izinCuti->id])}}" type="button" class="btn btn-md btn-outline-primary float-end" target="_blank"><i class="tf-icons bx bx-printer"></i> Cetak Izin Cuti</a>
  @endif

  <thead>
    <tr>
      <th class="text-nowrap"></th>
      <th class="text-nowrap text-center"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><h6 class="fw-bold">Status Permohonan</h6></td>
      <td><h6>@if ($izinCuti->status_permohonan == 0)
        <span class="text-warning">Dalam Proses</span>
    @elseif ($izinCuti->status_permohonan == 1)
        <span class="text-success">Disetujui Pimpinan</span>
    @elseif ($izinCuti->status_permohonan == 2)
        <span class="text-success">Disetujui Oleh Atasan</span>
        @elseif ($izinCuti->status_permohonan == 3)
        <span class="text-success">Telah Diverifikasi</span>
        @elseif ($izinCuti->status_permohonan == 4)
        <span class="text-success">Diterima</span>
      @else
      <span class="text-danger">Ditolak</span>
    @endif</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Jenis Cuti</h6></td>
      <td><h6>{{$izinCuti->jenis_cuti}}</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Alasan Cuti</h6></td>
      <td><h6>{{$izinCuti->alasan}}</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Lama Cuti</h6></td>
      <td><h6>{{$izinCuti->jumlah_hari}}</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Periode</h6></td>
      <td><h6>{{$izinCuti->periode_awal}} s/d {{$izinCuti->periode_akhir}}</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Alamat Saat Cuti</h6></td>
      <td><h6>{{$izinCuti->alamat_cuti}}</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">No. Tlp Saat Cuti</h6></td>
      <td><h6>{{$izinCuti->phone_cuti}}</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Atasan Langsung</h6></td>
      <td><h6>{{$izinCuti->atasan->nama}}</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Ketua Pengadilan</h6></td>
      <td><h6>{{$namaKetua->nama}}</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Lampiran</h6></td>
      <td><h6>-</h6></td>
    </tr>
    <tr>
      <td><h6 class="fw-bold">Dokumen</h6></td>
      <td><h6><a href="">Lihat Dokumen Persetujuan Cuti</a></h6></td>
    </tr>
  </tbody>
</table>



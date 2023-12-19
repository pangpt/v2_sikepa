@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Layanan/</span> Izin Cuti</h4>

<!-- Basic Layout -->
@if (session('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
      </button>
    </div>
    @endif
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center">
        {{-- <a href="{{route('izin-cuti-tambah')}}" type="button" class="btn btn-primary" >
          <span class="tf-icons bx bx-plus"></span>&nbsp; Pengajuan Cuti
        </a> --}}
        <a href="{{ $leaveTotal == null ? 'javascript:void(0);' : route('izin-cuti-tambah') }}" type="button" class="btn {{ $leaveTotal == null ? 'btn-danger' : 'btn-primary' }}"
            onclick="{{ $leaveTotal == null ? 'showSwal()' : '' }}">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Pengajuan Cuti
        </a>

        <a href="{{route('izin-cuti-penangguhan')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Ajukan Penangguhan
        </a>
        <a href="{{route('izin-cuti-index-verifikasi')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-check-square"></span>&nbsp; Verifikasi Cuti ({{$jmlVerif}})
        </a>
        <a href="{{route('izin-cuti-index-approval')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-check-square"></span>&nbsp; Approval Cuti (Atasan) ({{$jmlApprove}})
        </a>

        @if(auth()->user()->role === 'kepegawaian')
        <a href="{{route('izin-cuti-yearly')}}" type="button" class="btn btn-secondary">
          <span class="tf-icons bx bx-cog"></span>&nbsp; Set Cuti
        </a>
        @endif
        <small class="text-muted float-end">Total: 1 Izin Cuti</small>
      </div>
      <div class="card-body">
        <h6 class="mb-4 text-muted">Klik Nama Lengkap untuk melihat data detail</h6>
        <table id="pegawaiTable" class="display">
          <thead>
            <tr>
              <th>Tanggal Pengajuan</th>
              <th>Nama</th>
              <th>Jenis Cuti</th>
              <th>Tanggal Cuti</th>
              <th>Lama Cuti</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $key)
            <tr>
              <td>{{$key->created_at}}</td>
              <td><a href="{{route('izin-cuti-detail',['id' => $key->id])}}">{{$key->employee->nama}}</a></td>
              <td>{{$key->jenis_cuti}}</td>
              <td>{{$key->periode_awal}} <b>s/d</b> {{$key->periode_akhir}}</td>
              <td>{{$key->jumlah_hari}} hari</td>
              @if($key->status_permohonan == 0)
              <td>Menunggu Diverifikasi</td>
              @endif
              @if ($key->status_permohonan == 1)
                <td>Disetujui Pimpinan</td>
              @endif
              @if ($key->status_permohonan == 2)
                <td>Disetujui Atasan</td>
              @endif
              @if ($key->status_permohonan == 3)
                <td>Verifikasi</td>
              @endif
              @if ($key->status_permohonan == 4)
                <td>Diterima</td>
              @endif
              @if ($key->status_permohonan == 5)
                <td>Ditolak</td>
              @endif
            </tr>
            @endforeach
            <!-- Tambahkan baris data pegawai dan hakim lainnya di sini -->
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
      $('#pegawaiTable').DataTable({
        "ordering": false, // Menonaktifkan fitur pengurutan (sort)
        "language": {
          "searchPlaceholder": "NIP / Nama" // Menambahkan placeholder pada input search
        }
      });
    });
  </script>
  <script>
    function showSwal() {
        swal("Maaf", "izin cuti belum disetting, silahkan hubungi kasubag kepegawaian", "error");
    }
  </script>

@endsection

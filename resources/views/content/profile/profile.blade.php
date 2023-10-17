@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistem Administrasi Kepegawaian / Profil Hakim & Pegawai /</span> Detail
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-5">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <h3 class="d-none d-sm-block">{{Auth::user()->employee->nama}}</h3>
            <p class="mb-0">NIP : {{Auth::user()->employee->nip}}</p>
            <p class="mb-0">TGL.LAHIR / USIA : {{@(\Carbon\Carbon::parse(Auth::user()->employee->tanggal_lahir)->format('d F Y'))}} / {{ \Carbon\Carbon::parse(Auth::user()->employee->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y tahun') }}
            </p>
            {{-- <p class="mb-0">STATUS : {{Auth::user()->employee->is_active = 1 ? 'AKTIF' : 'TIDAK AKTIF'}}</p> --}}
        </div>
          <div class="button-wrapper">
            <p class="mb-0">Golongan : {{Auth::user()->employee->golongan->pangkat}} - {{Auth::user()->employee->golongan->jenis_golongan}}</p>
            <p class="mb-0">Jabatan : {{Auth::user()->employee->department->nama_jabatan}}</p>
            <p class="mb-0">Bagian : {{Auth::user()->employee->department->nama_jabatan}}</p>
          </div>
          <div class="button-wrapper">
            <p class="mb-0">Email : {{Auth::user()->employee->email != null ? Auth::user()->employee->email : '-' }}</p>
            <p class="mb-0">No. HP :  {{Auth::user()->employee->phone != null ? Auth::user()->employee->phone : '-' }}</p>
            <p class="mb-0">Status Akun :  {{Auth::user()->employee->is_active = 1 ? 'AKTIF' : 'TIDAK AKTIF'}}</p>
          </div>
          <div class="button-wrapper">
            <a href="{{route('profil-pegawai-detail',['nip' => Auth::user()->employee->nip])}}" class="btn btn-primary btn-sm"><span class="tf-icons bx bx-info-circle"></span> Detail Informasi</a>
          </div>


        </div>
        {{-- <a href="{{route('profil-pegawai-detail', ['nip' => Auth::user()->employee->nip])}}" class="btn btn-primary">
          <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah
        </a> <small class="text-muted float-end">Total PNS: 50 aktif</small> --}}
      </div>
    </div>

    <div class="card">
      <h5 class="card-header">Delete Account</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

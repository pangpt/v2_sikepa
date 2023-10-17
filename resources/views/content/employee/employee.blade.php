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
      <!-- Account -->
      {{-- <div class="card-body"> --}}
        {{-- <div class="d-flex align-items-start align-items-sm-center gap-5"> --}}
          {{-- <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <h3 class="d-none d-sm-block">{{Auth::user()->employee->nama}}</h3>
            <p class="mb-0">NIP : {{Auth::user()->employee->nip}}</p>
            <p class="mb-0">TGL.LAHIR / USIA : {{@(\Carbon\Carbon::parse(Auth::user()->employee->tanggal_lahir)->format('d F Y'))}} / {{ \Carbon\Carbon::parse(Auth::user()->employee->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y tahun') }}
            </p> --}}
            {{-- <p class="mb-0">STATUS : {{Auth::user()->employee->is_active = 1 ? 'AKTIF' : 'TIDAK AKTIF'}}</p> --}}
        {{-- </div>
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


        </div> --}}
        {{-- <a href="{{route('profil-pegawai-detail', ['nip' => Auth::user()->employee->nip])}}" class="btn btn-primary">
          <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah
        </a> <small class="text-muted float-end">Total PNS: 50 aktif</small> --}}
      {{-- </div> --}}
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-5">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <h3 class="d-none d-sm-block">{{$emp->nama}}</h3>
            <p class="mb-0">NIP : {{$emp->nip}}</p>
            <p class="mb-0">TGL.LAHIR / USIA : {{@(\Carbon\Carbon::parse($emp->tanggal_lahir)->format('d F Y'))}} / {{ \Carbon\Carbon::parse($emp->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y tahun') }}
            </p>
            {{-- <p class="mb-0">STATUS : {{Auth::user()->employee->is_active = 1 ? 'AKTIF' : 'TIDAK AKTIF'}}</p> --}}
        </div>
          <div class="button-wrapper">
            <p class="mb-0">Golongan : {{$emp->golongan->pangkat}} - {{$emp->golongan->jenis_golongan}}</p>
            <p class="mb-0">Jabatan : {{$emp->department->nama_jabatan}}</p>
            <p class="mb-0">Bagian : {{$emp->department->kategori}}</p>
          </div>
          <div class="button-wrapper">
            <p class="mb-0">Email : {{$emp->email != null ? $emp->email : '-' }}</p>
            <p class="mb-0">No. HP :  {{$emp->phone != null ? $emp->phone : '-' }}</p>
            <p class="mb-0">Status Akun :  {{$emp->is_active = 1 ? 'AKTIF' : 'TIDAK AKTIF'}}</p>
          </div>


        </div>
        {{-- <a href="{{route('profil-pegawai-detail', ['nip' => Auth::user()->employee->nip])}}" class="btn btn-primary">
          <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah
        </a> <small class="text-muted float-end">Total PNS: 50 aktif</small> --}}
      </div>
    </div>
    @if (session('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
      </button>
    </div>
    @endif
    <div class="nav-align-top mb-4">
      <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
          <button
            type="button"
            class="nav-link active"
            role="tab"
            data-bs-toggle="tab"
            data-bs-target="#navs-justified-home"
            aria-controls="navs-justified-home"
            aria-selected="true"
          >
            <i class="tf-icons bx bx-home"></i> Data Pribadi
            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">3</span>
          </button>
        </li>
        <li class="nav-item">
          <button
            type="button"
            class="nav-link"
            role="tab"
            data-bs-toggle="tab"
            data-bs-target="#navs-justified-profile"
            aria-controls="navs-justified-profile"
            aria-selected="false"
          >
            <i class="tf-icons bx bx-user"></i> Data Izin Cuti
          </button>
        </li>
        <li class="nav-item">
          <button
            type="button"
            class="nav-link"
            role="tab"
            data-bs-toggle="tab"
            data-bs-target="#navs-justified-messages"
            aria-controls="navs-justified-messages"
            aria-selected="false"
          >
            <i class="tf-icons bx bx-message-square"></i> Data Kepangkatan
          </button>
        </li>
        <li class="nav-item">
          <button
            type="button"
            class="nav-link"
            role="tab"
            data-bs-toggle="tab"
            data-bs-target="#navs-justified-messages"
            aria-controls="navs-justified-messages"
            aria-selected="false"
          >
            <i class="tf-icons bx bx-message-square"></i> Data Pendidikan
          </button>
        </li>
        <li class="nav-item">
          <button
            type="button"
            class="nav-link"
            role="tab"
            data-bs-toggle="tab"
            data-bs-target="#navs-justified-messages"
            aria-controls="navs-justified-messages"
            aria-selected="false"
          >
            <i class="tf-icons bx bx-message-square"></i> Data PKP
          </button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
          @include('content.employee.data-pribadi')
        </div>
        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
          @include('content.employee.data-cuti')
        </div>
        <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
          @include('content.employee.data-kepangkatan')
        </div>
        <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
          @include('content.employee.data-pendidikan')
        </div>
        <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
          @include('content.employee.data-pkp')
        </div>
      </div>
    </div>
    {{-- <div class="card">
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
    </div> --}}
  </div>
</div>
@endsection

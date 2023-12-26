@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistem Administrasi Kepegawaian / Profil Hakim & Pegawai /</span> Tambah
</h4>

@if (session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
      </button>
    </div>
    @endif

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('profil-hakim-pegawai-addPegawai')}}" method="POST">
          @csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Nama Lengkap</label>
              <input class="form-control" type="text" id="nama" name="nama" value="{{old('nama')}}" autofocus required/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="nip" class="form-label">NIP</label>
              <input class="form-control" type="text" id="nip" name="nip" value="{{old('nip')}}" autofocus required/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="tmt" class="form-label">TMT Awal</label>
              <input class="form-control" type="date" id="tmt" name="tmt" value="{{old('tmt')}}" required/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="{{old('email')}}"/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="golongan" class="form-label">Golongan</label>
              <select id="golongan" class="select2 form-select" name="golongan" required>
                <option value="{{old('golongan')}}">Pilih Golongan-Pangkat</option>
                @foreach($golongan as $key)
                    <option value="{{ $key->id }}">{{ $key->jenis_golongan }} - {{$key->pangkat}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phone">Nomor Telepon/HP</label>
              <div class="input-group input-group-merge">
                {{-- <span class="input-group-text">ID (+1)</span> --}}
                <input type="text" id="phone" name="phone" class="form-control" value="{{old('phone')}}" />
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="jabatan" class="form-label">Jabatan</label>
              <select id="jabatan" class="select2 form-select" name="jabatan" required>
                <option value="{{old('jabatan')}}">Pilih Jabatan</option>
                @foreach($jabatan as $key)
                    <option value="{{ $key->id }}">{{ $key->nama_jabatan }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="role" class="form-label">Role Pengguna</label>
              <select id="role" class="select2 form-select" name="role" required>
                <option value="{{old('role')}}">- Pilih Role -</option>
                <option value="ketua">Ketua</option>
                <option value="panitera">Panitera</option>
                <option value="sekretaris">Sekretaris</option>
                <option value="kasubag">Kepegawaian</option>
                <option value="pegawai">Pegawai</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
            </div>
          </div>
          <div class="mt-2">
            <button id="submitButton" type="submit" class="btn btn-primary me-2">
              <div id="loadingSpinner" class="spinner-border spinner-border-sm text-white" role="status" style="display: none">
                <span class="visually-hidden">Loading...</span>
              </div>
              Simpan
            </button>
            {{-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> --}}
          </div>
        </form>
        </div>
    </div>
  </div>
</div>
@endsection

@section('js-after')
<script>
  document.addEventListener("DOMContentLoaded", function () {
      var submitButton = document.getElementById("submitButton");
      // var buttonText = document.getElementById("buttonText");
      var loadingSpinner = document.getElementById("loadingSpinner");

      submitButton.addEventListener("click", function () {
          // buttonText.style.display = "none";
          loadingSpinner.style.display = "inline-block";

          // Simulasikan proses input form (gantilah ini dengan aksi sebenarnya)
          setTimeout(function () {
              // Setelah selesai, kembalikan tombol ke keadaan awal
              // buttonText.style.display = "inline-block";
              loadingSpinner.style.display = "none";
          }, 3000); // Ganti angka 3000 dengan waktu yang sesuai dengan proses input form
      });
  });
</script>

@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Profil /</span> Data Pribadi
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header justify-content-between align-items-center">
        <a href="{{route('profil-hakim-pegawai-pns')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-left-arrow-alt"></span>
        </a>
      </div>
      <h5 class="card-header">Tambah Profil Hakim dan Pegawai</h5>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload foto baru</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Nama Lengkap</label>
              <input class="form-control" type="text" id="firstName" name="firstName" value="John" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="nip" class="form-label">NIP</label>
              <input class="form-control" type="text" id="nip" name="nip" value="199609022020121004" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="john.doe@example.com" placeholder="john.doe@example.com" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="golongan" class="form-label">Golongan</label>
              <select id="golongan" class="select2 form-select">
                <option value="">Pilih Golongan</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Nomor Telepon/HP</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">US (+1)</span>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="202 555 0111" />
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="jabatan" class="form-label">Jabatan</label>
              <input class="form-control" type="text" id="jabatan" name="jabatan" placeholder="California" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="zipCode" class="form-label">Zip Code</label>
              <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" />
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection

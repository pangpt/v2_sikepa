{{-- <div class="card mb-4"> --}}
  <!-- Account -->
  {{-- <div class="card-body"> --}}
    {{-- <div class="d-flex align-items-start align-items-sm-center gap-4">
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
    </div> --}}
  {{-- </div> --}}
  {{-- <hr class="my-0"> --}}
  {{-- <div class="card-body"> --}}
    <form action="{{route('profil-pegawai-update', ['nip' => $pegawaidetail->nip])}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="firstName" class="form-label">Nama Lengkap</label>
          <input class="form-control" type="text" id="nama" name="nama" value="{{$pegawaidetail->nama}}" autofocus />
        </div>
        <div class="mb-3 col-md-6">
          <label for="nip" class="form-label">NIP</label>
          <input class="form-control" type="text" id="nip" name="nip" value="{{$pegawaidetail->nip}}" autofocus />
        </div>
        <div class="mb-3 col-md-6">
          <label for="email" class="form-label">E-mail</label>
          <input class="form-control" type="text" id="email" name="email" value="{{$pegawaidetail->email}}" />
        </div>
        <div class="mb-3 col-md-6">
          <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
          <input class="form-control" type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{$pegawaidetail->tanggal_lahir}}" />
        </div>
        <div class="mb-3 col-md-6">
          <label for="tmt" class="form-label">TMT</label>
          <input class="form-control" type="date" id="tmt" name="tmt" value="{{$pegawaidetail->tmt}}" />
        </div>
        <div class="mb-3 col-md-6">
          <label for="golongan_id" class="form-label">Golongan</label>
          <select id="golongan_id" class="select2 form-select" name="golongan_id">
            @foreach ($golongan as $item)
              <option value="{{ $item->id }}" {{ $item->id == $pegawaidetail->golongan_id ? 'selected' : '' }}>
                  {{ $item->jenis_golongan }} - {{$item->pangkat}}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3 col-md-6">
          <label class="form-label" for="phone">Nomor Telepon/HP</label>
          <div class="input-group input-group-merge">
            {{-- <span class="input-group-text">ID (+1)</span> --}}
            <input type="text" id="phone" name="phone" class="form-control" value="{{$pegawaidetail->phone}}" />
          </div>
        </div>
        <div class="mb-3 col-md-6">
          <label for="department_id" class="form-label">Jabatan</label>
          <select id="department_id" class="select2 form-select" name="department_id">
            @foreach ($position as $item)
              <option value="{{ $item->id }}" {{ $item->id == $pegawaidetail->department_id ? 'selected' : '' }}>
                  {{ $item->nama_jabatan }}
              </option>
            @endforeach
          </select>
        </div>
        {{-- <div class="mb-3 col-md-6">
          <label for="jabatan" class="form-label">Jabatan</label>
          <input class="form-control" type="text" id="department_id" name="department_id" value="{{$pegawaidetail->department->nama_jabatan}}" />
        </div> --}}
        <div class="mb-3 col-md-6">
          <label for="alamat" class="form-label">Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat" rows="3">{{$pegawaidetail->alamat}}</textarea>
          {{-- <input type="text" class="form-control" id="alamat" name="alamat" value="{{$pegawaidetail->alamat}}" /> --}}
        </div>
        {{-- <div class="mb-3 col-md-6">
          <label for="zipCode" class="form-label">Zip Code</label>
          <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" />
        </div> --}}
      </div>
      <div class="mt-2">
        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
        {{-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> --}}
      </div>
    </form>
  {{-- </div> --}}
  <!-- /Account -->
{{-- </div> --}}

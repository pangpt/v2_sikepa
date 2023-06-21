@extends('layouts/contentNavbarLayout')

@section('title', ' Horizontal Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Horizontal Layouts</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-12">
    <div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true"><i class="tf-icons bx bx-home"></i> Pengajuan Cuti</button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false"><i class="tf-icons bx bx-user"></i> Penangguhan Cuti</button>
        </li>
      </ul>
      <div class="tab-content">
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
                  <tr>
                    <td class="text-nowrap">Tahunan</td>
                    <td>
                      2021
                    </td>
                    <td>
                      0
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap">Tahunan</td>
                    <td>
                      2022
                    </td>
                    <td>
                      6
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap">Tahunan</td>
                    <td>
                      2023
                    </td>
                    <td>
                      12
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Form Permohonan Cuti</h5>
            </div>
            <div class="card-body">
              <form>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Jenis Cuti</label>
                  <div class="col-sm-10">
                    <select id="golongan" class="select2 form-select">
                      <option value="">Pilih -</option>
                      <option value="en">English</option>
                      <option value="fr">French</option>
                      <option value="de">German</option>
                      <option value="pt">Portuguese</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Alasan</label>
                  <div class="col-sm-10">
                    <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-company">Periode</label>
                  <div class="col-sm-5">
                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                  </div>
                  <div class="col-sm-5">
                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-company">Jumlah Hari</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="1 Hari" readonly="readonly"/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat Saat Cuti</label>
                  <div class="col-sm-10">
                    <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">No. Telp Saat Cuti</label>
                  <div class="col-sm-10">
                    <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Atasan Langsung</label>
                  <div class="col-sm-10">
                    <select id="golongan" class="select2 form-select">
                      <option value="">Pilih -</option>
                      <option value="en">English</option>
                      <option value="fr">French</option>
                      <option value="de">German</option>
                      <option value="pt">Portuguese</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Pejabat Berwenang</label>
                  <div class="col-sm-10">
                    <select id="golongan" class="select2 form-select">
                      <option value="">Pilih -</option>
                      <option value="en">English</option>
                      <option value="fr">French</option>
                      <option value="de">German</option>
                      <option value="pt">Portuguese</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">Lampiran</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Send</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Form Permohonan Cuti</h5>
            </div>
            <div class="card-body">
              <form>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Jenis Cuti</label>
                  <div class="col-sm-10">
                    <select id="golongan" class="select2 form-select">
                      <option value="">Pilih -</option>
                      <option value="en">English</option>
                      <option value="fr">French</option>
                      <option value="de">German</option>
                      <option value="pt">Portuguese</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Alasan</label>
                  <div class="col-sm-10">
                    <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-company">Periode</label>
                  <div class="col-sm-5">
                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                  </div>
                  <div class="col-sm-5">
                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-company">Jumlah Hari</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="1 Hari" readonly="readonly"/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat Saat Cuti</label>
                  <div class="col-sm-10">
                    <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">No. Telp Saat Cuti</label>
                  <div class="col-sm-10">
                    <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Atasan Langsung</label>
                  <div class="col-sm-10">
                    <select id="golongan" class="select2 form-select">
                      <option value="">Pilih -</option>
                      <option value="en">English</option>
                      <option value="fr">French</option>
                      <option value="de">German</option>
                      <option value="pt">Portuguese</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Pejabat Berwenang</label>
                  <div class="col-sm-10">
                    <select id="golongan" class="select2 form-select">
                      <option value="">Pilih -</option>
                      <option value="en">English</option>
                      <option value="fr">French</option>
                      <option value="de">German</option>
                      <option value="pt">Portuguese</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">Lampiran</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Send</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="col-xxl">
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
            <tr>
              <td class="text-nowrap">Tahunan</td>
              <td>
                2021
              </td>
              <td>
                0
              </td>
            </tr>
            <tr>
              <td class="text-nowrap">Tahunan</td>
              <td>
                2022
              </td>
              <td>
                6
              </td>
            </tr>
            <tr>
              <td class="text-nowrap">Tahunan</td>
              <td>
                2023
              </td>
              <td>
                12
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Form Pengajuan</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Form Penangguhan</a></li>
    </ul>
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Form Permohonan Cuti</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Jenis Cuti</label>
            <div class="col-sm-10">
              <select id="golongan" class="select2 form-select">
                <option value="">Pilih -</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Alasan</label>
            <div class="col-sm-10">
              <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Periode</label>
            <div class="col-sm-5">
              <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
            </div>
            <div class="col-sm-5">
              <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Jumlah Hari</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-company" placeholder="1 Hari" readonly="readonly"/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat Saat Cuti</label>
            <div class="col-sm-10">
              <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-phone">No. Telp Saat Cuti</label>
            <div class="col-sm-10">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Atasan Langsung</label>
            <div class="col-sm-10">
              <select id="golongan" class="select2 form-select">
                <option value="">Pilih -</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Pejabat Berwenang</label>
            <div class="col-sm-10">
              <select id="golongan" class="select2 form-select">
                <option value="">Pilih -</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-phone">Lampiran</label>
            <div class="col-sm-10">
              <input class="form-control" type="file" id="formFile">
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div> --}}
</div>
@endsection

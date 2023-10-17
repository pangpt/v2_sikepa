@extends('layouts/contentNavbarLayout')

@section('title', ' Horizontal Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Horizontal Layouts</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-12">
    <div class="nav-align-top mb-4">
        <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Pengaturan Informasi Satuan Kerja</h5>
            </div>
            <div class="card-body">
              <form id="satkerForm">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Nama Pengadilan</label>
                  <div class="col-sm-10">
                    <input type="text" id="basic-default-phone" name="nama_satker" class="form-control fw-bold" value="{{@$data->nama_satker}}" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat</label>
                  <div class="col-sm-10">
                    <textarea id="basic-default-message" name="alamat_satker" class="form-control fw-bold" value="{{@$data->alamat_satker}}" aria-describedby="basic-icon-default-message2">{{@$data->alamat_satker}}</textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">No. Telp</label>
                  <div class="col-sm-10">
                    <input type="text" id="basic-default-phone" name="phone_satker" class="form-control fw-bold" value="{{@$data->phone_satker}}" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Wilayah</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control fw-bold" id="wilayah_satker" name="wilayah_satker" value="{{@$data->wilayah_satker}}"/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Ketua Pengadilan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control fw-bold" id="pimpinan_satker" name="pimpinan_satker" value="{{@$data->pimpinan_satker}}"/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Website</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control fw-bold" id="website_satker" name="website_satker" value="{{@$data->website_satker}}"/>
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">
                      <div id="loadInput" class="spinner-border spinner-border-sm text-white" role="status" style="display: none;">
                          <span class="visually-hidden">Loading...</span>
                      </div>
                      Simpan
                  </button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const satkerForm = document.getElementById('satkerForm');
    const loadingSpinner = document.getElementById('loadingSpinner');

    satkerForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(satkerForm);

        // Kirim perubahan peran ke server dengan AJAX
        $('#loadInput').show();
        $.ajax({
          '_token': '{{ csrf_token() }}',
            method: 'POST',
            url: "{{ route('datamaster-satker-create') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
              location.reload();
              $('#spinner').hide();
            },
            error: function (response) {
                // Handle error jika terjadi
                console.error('Terjadi kesalahan: ' + response.responseJSON.message);

                // Menyembunyikan spinner setelah permintaan selesai
                loadingSpinner.style.display = 'none';
            }
        });
    });
});




</script>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')
<style>
  ul.timeline {
          list-style-type: none;
          position: relative;
        }
        ul.timeline:before {
          content: ' ';
          background: #d4d9df;
          display: inline-block;
          position: absolute;
          left: 29px;
          width: 2px;
          height: 100%;
          z-index: 400;
        }
        ul.timeline > li {
          margin: 20px 0;
          padding-left: 20px;
        }
        ul.timeline > li:before {
          content: ' ';
          background: white;
          display: inline-block;
          position: absolute;
          border-radius: 50%;
          border: 3px solid #22c0e8;
          left: 20px;
          width: 20px;
          height: 20px;
          z-index: 400;
        }
        ul.timeline > li.active:before {
          /* Change the color to the desired primary color */
          background: #007bff;
        }
  </style>

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistem Administrasi Kepegawaian / Layanan /</span> Izin Cuti
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <!-- Account -->
      <div class="card-header d-flex align-items-center justify-content-between pb-0 mb-4">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Profil Permohon</h5>
        </div>
      </div>
      <div class="card-body">
          <h6><i class="tf-icons bx bx-user-circle"></i><span class="fw-bold"> Nama Lengkap </span> : {{$izinCuti->employee->nama}}</h6>
          <h6><i class="tf-icons bx bx-user"></i><span class="fw-bold"> NIP </span> : {{$izinCuti->employee->nip}}</h6>
          <h6><i class="tf-icons bx bx-user-pin"></i><span class="fw-bold"> Jabatan </span> : {{$jab->nama_jabatan}}</h6>
          <h6><i class="tf-icons bx bx-info-circle"></i><span class="fw-bold"> Status </span> : {{$izinCuti->employee->nip}}</h6>
      </div>
    </div>
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
            <i class="tf-icons bx bx-home"></i> Data Permohonan Cuti
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
            <i class="tf-icons bx bx-user"></i> Track Permohonan Cuti
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
            <i class="tf-icons bx bx-message-square"></i> Catatan Cuti
          </button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
          @include('content.izin-cuti.data-permohonan-cuti')
        </div>
        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
          @include('content.izin-cuti.data-track')
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
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tolakModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Tolak Pengajuan Cuti</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Catatan</label>
            <input type="text" id="nameBasic" class="form-control" placeholder="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="setujuiModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Approve Pengajuan Cuti</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Catatan</label>
            <input type="hidden" name="leave_id" value="{{ $izinCuti->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="text" name="catatan" id="catatanField" class="form-control" placeholder="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="approveBtn">Simpan</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js-after')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $('#approveBtn').click(function() {
          var catatan = $('#catatanField').val();
          var leaveId =  {{ $izinCuti->id }}
          var userId =  {{ auth()->user()->id }}
          // console.log(userId)
          var departmentId =  {{ auth()->user()->employee->department->id }}
          var employeeId = {{$izinCuti->employee_id}}
          // console.log(departmentId)
          var userRole = '{{ auth()->user()->role }}';

          $.ajax({
              method: 'POST',
              url: "{{ route('izin-cuti-approve') }}",
              data: {
                  '_token': '{{ csrf_token() }}',
                  catatan: catatan,
                  leave_id: leaveId,
                  user_id: userId,
                  department_id: departmentId,
                  employee_id: employeeId,
                  role: userRole
              },
              success: function(response) {
                  // Handle respons dari server
                  console.log(response.message);

                  // Tutup modal
                  $('#setujuiModal').modal('hide');
                  location.reload()

              },
              error: function(response) {
                  // Handle error jika terjadi
                  console.error('Terjadi kesalahan: ' + response.responseJSON.message);
              }
          });
      });
  });
</script>

{{-- <script>
$('#setujuiModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Tombol yang membuka modal
    var catatan = button.data('catatan'); // Ambil data-catatan dari tombol
    var modal = $(this);
    modal.find('#catatanField').val(catatan); // Setel nilai #catatanField sesuai data-catatan
console.log({{auth()->user()->id}}, {{$izinCuti->id}})
    // AJAX request untuk menolak pengajuan cuti
    $('#approveBtn').click(function () {
      var catatan = $('#catatan').val();
      var leave_id = {{ $izinCuti->id }}; // Gantilah dengan cara Anda mengambil ID pengajuan cuti
      var user_id = {{ auth()->user()->id }};
      $.ajax({
        method: 'POST',
        url: '/izin-cuti/approve',
        data: {
          "_token": "{{ csrf_token() }}",
          leave_id: leave_id,
          catatan: catatan,
          user_id: user_id,
        },
        success: function (data) {
          alert(data.message);
          $('#setujuiModal').modal('hide'); // Tutup modal setelah berhasil menolak
        },
        error: function (error) {
          console.error(error);
          // Tampilkan pesan kesalahan jika diperlukan
        },
      });
    });
  });
</script> --}}
@endsection

@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            @include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])
          </span>
          <span class="app-brand-text demo menu-text fw-bolder">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center">
            {{-- <b>Waktu sekarang: {{ \Carbon\Carbon::now('Asia/Makassar')->locale('id')->format('D, d M Y, H:i:s') }}</b> --}}
            <b>Waktu Sekarang : <span id="current-day"></span>, <span id="current-date"></span> - <span id="current-time"></span></b>
          </div>
        </div>
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <!-- User -->
          <li class="nav-item p-2">
            <div id="loadingSpinner" class="spinner-border spinner-border-sm text-primary" role="status" style="display: none">
              <span class="visually-hidden">Loading...</span>
            </div>
          </li>
          <li class="nav-item navbar-dropdown dropdown-user dropdown p-2">
            <button class="dropdown-toggle hide-arrow btn btn-sm btn-outline-primary" data-bs-toggle="dropdown">
              <span class="fw-semibold d-block">{{auth()->user()->role}}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                  <span class="dropdown-item fw-bold align-middle">Role User</span>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="admin">
                  <span class="align-middle">Root (Admin)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="ketua">
                  <span class="align-middle">Pimpinan (Ketua)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="panitera">
                  <span class="align-middle">Atasan (Panitera)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="sekretaris">
                  <span class="align-middle">Atasan (Sekretaris)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="kepegawaian">
                  <span class="align-middle">Verifikator (Kasubag Kepegawaian)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="pegawai">
                  <span class="align-middle">Pegawai (Pegawai)</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <i class="flex-grow-tf-icons bx bx-bell bx-sm"></i>
              {{-- Assuming $notificationCount is passed to the view with the count of notifications --}}
              <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">1000</span>
          </a>

            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                  <span class="dropdown-item fw-bold align-middle">Role User</span>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="admin">
                  <span class="align-middle">Root (Admin)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="ketua">
                  <span class="align-middle">Pimpinan (Ketua)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="panitera">
                  <span class="align-middle">Atasan (Panitera)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="sekretaris">
                  <span class="align-middle">Atasan (Sekretaris)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="kepegawaian">
                  <span class="align-middle">Verifikator (Kasubag Kepegawaian)</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item change-role" href="#" data-role="pegawai">
                  <span class="align-middle">Pegawai (Pegawai)</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">John Doe</span>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <i class="bx bx-user me-2"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <form action="{{route('logout')}}" method="post">
                  @csrf
                  <button class="dropdown-item" type="submit">
                    <i class='bx bx-power-off me-2'></i>
                    <span class="align-middle">Log Out</span>
                  </button>
                </form>

              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->

  <!-- resources/views/layouts/navbar.blade.php -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.change-role').click(function (e) {
            e.preventDefault();

            var newRole = $(this).data('role');
            var userId = {{ auth()->user()->id }};
            console.log(newRole)

            // Kirim perubahan peran ke server dengan AJAX
            $('#loadingSpinner').show();
            $.ajax({
                // url: '{{ route('change-user-role') }}',
                url: '/change-user-role',
                method: 'POST',
                data: {
                    role: newRole,
                    id: userId,
                    "_token": '{{ csrf_token() }}',
                },
                success: function (response) {
                    if (response.success) {
                        // Peran berhasil diubah
                        location.reload();
                        $('#spinner').hide();

                        // Update ikon sesuai dengan peran yang dipilih
                        // Misalnya, jika role 'admin' dipilih, Anda dapat menambahkan ikon 'admin' di sini.
                        // Anda bisa menggunakan CSS atau JavaScript untuk mengganti ikon sesuai dengan peran yang dipilih.
                    } else {
                        // Gagal mengubah peran
                        alert('Gagal mengubah peran.');
                    }
                },
                error: function () {
                    // Terjadi kesalahan dalam permintaan AJAX
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
</script>


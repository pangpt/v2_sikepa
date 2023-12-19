@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
@if(session('error'))
    <script>
        window.onload = function() {
            showSwal('{{ session('error') }}');
        };
    </script>
@endif

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])</span>
              <span class="app-brand-text demo text-body fw-bolder">{{config('variables.templateName')}}</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Selamat Datang di {{config('variables.templateName')}}! 👋</h4>
          @if (session('login_error'))
            <div class="alert alert-primary alert-dismissible" role="alert">
              {{ session('login_error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              </button>
            </div>
            @endif
          {{-- <p class="mb-4">Please sign-in to your account and start the adventure</p> --}}

          <form id="formAuthentication" class="mb-3" action="{{route('proseslogin')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">NIP</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan NIP Anda" value="{{old('username')}}" autofocus required>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="{{url('auth/forgot-password-basic')}}">
                  <small>Lupa Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan Kata Sandi Anda" aria-describedby="password" required/>
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
            </div>
          </form>

          {{-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Create an account</span>
            </a>
          </p> --}}
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection
@section('page-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

  <script>
    function showSwal() {
        swal("Maaf", "akun anda belum aktif, silahkan hubungi kasubag kepegawaian", "error");
    }
  </script>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header justify-content-between align-items-center">
        <a href="{{route('informasi-create-page')}}" type="button" class="btn btn-primary">
          <span class="tf-icons bx bx-plus"></span>&nbsp; Buat Informasi
        </a>
        <small class="text-muted float-end">Total: {{$info->count()}} Informasi</small>
      </div>
      <div class="card-body">
        <h6 class="mb-4 text-muted">Klik Nama Lengkap untuk melihat data detail</h6>
        <table id="pegawaiTable" class="display">
          <thead>
            <tr>
              <th>#</th>
              <th>Judul</th>
              <th>Tanggal</th>
              <th>File</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($info as $key)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$key->judul}}</td>
              <td>{{date('d-m-Y', strtotime($key->tanggal))}}</td>
              <td>{{$key->file_path}}</td>
              <td>
                <a href="{{route('informasi-baru-edit', ['id' => $key->id])}}" style="color:inherit; text-decoration: none">
                  <i class="tf-icons bx bx-edit"></i>
                </a>
                <a href="" style="color:inherit; text-decoration: none">
                  <i class="tf-icons bx bx-trash"></i>
                </a>
              </td>
            </tr>
            @endforeach
            <!-- Tambahkan baris data pegawai dan hakim lainnya di sini -->
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Buat PKP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Periode Mulai</label>
            <input class="form-control" type="date" id="html5-date-input" />
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Periode Selesai</label>
            <input class="form-control" type="date" id="html5-date-input" />
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            {{-- <label for="nameBasic" class="form-label">Pilih Pejabat Langsung</label> --}}
            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
              <option selected>Pilih Pejabat Langsung</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
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

@endsection
@section('page-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#pegawaiTable').DataTable({
        "ordering": false, // Menonaktifkan fitur pengurutan (sort)
        "language": {
          "searchPlaceholder": "Ketik di sini untuk mencari PKP berdasarkan Nama, Atasan Langsung, atau Periode." // Menambahkan placeholder pada input search
        }
      });
    });
  </script>
@endsection

@extends('layouts/contentNavbarLayout')
<?php
$module_icon = "fa-solid fa-list-check";
?>
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> @lang('Log') [{{ $log->date }}]
                    <small class="text-muted"> @lang('Details') </small>
                </h4>
                <div class="small text-muted">
                    @lang('Log Viewer Module')
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">

                <div class="row">
                    <div class="col-lg-12">
                        {{-- Log Details --}}
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>
                                    @lang('Log Info')
                                </strong>
                                <div class="btn-toolbar float-end">
                                    <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-success">
                                        <i class="fas fa-download"></i>&nbsp;@lang('Download')
                                    </a>
                                    <a href="#delete-log-modal" class="btn btn-danger ms-1" data-coreui-toggle="modal">
                                        <i class="fas fa-trash-alt"></i>&nbsp;@lang('Delete')
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-condensed mb-0">
                                    <tbody>
                                        <tr>
                                            <td>File path :</td>
                                            <td colspan="7">{{ $log->getPath() }}</td>
                                        </tr>
                                        <tr>
                                            <td>Log entries : </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $entries->total() }}</span>
                                            </td>
                                            <td>Size :</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $log->size() }}</span>
                                            </td>
                                            <td>Created at :</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $log->createdAt() }}</span>
                                            </td>
                                            <td>Updated at :</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $log->updatedAt() }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{--  --}}
                        </div>

                        {{-- Log Entries --}}
                        <div class="card mb-4">
                            @if ($entries->hasPages())
                            <div class="card-header">
                                <span class="badge badge-info float-end">
                                    Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                                </span>
                            </div>
                            @endif
                                <table id="logsTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>ENV</th>
                                            <th >Time</th>
                                            <th>Header</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($entries as $key => $entry)
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary">{{ $entry->env }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                  {{ \Carbon\Carbon::parse($entry->datetime)->locale('id')->isoFormat('dddd, D MMMM Y HH:mm:ss') }} WIB

                                                </span>
                                            </td>
                                            <td>
                                                {!! $entry->header !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>

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
      $('#logsTable').DataTable({
        "ordering": false, // Menonaktifkan fitur pengurutan (sort)
        "pageLength": 50,
        "language": {
          "searchPlaceholder": "NIP / Nama" // Menambahkan placeholder pada input search
        }
      });
    });
  </script>
@endsection

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
                    <i class="{{$module_icon}}"></i> {{ __('Logs by Date') }}
                    <small class="text-muted">List </small>
                </h4>
                <div class="small text-muted">
                    @lang('Log Viewer Module')
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                @foreach($headers as $key => $header)
                                <th scope="col" class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                    @if ($key == 'date')
                                    {{ $header }}
                                    @else
                                    <span class="badge badge-level-{{ $key }}">
                                        {!! log_styler()->icon($key) . ' ' . $header !!}
                                    </span>
                                    @endif
                                </th>
                                @endforeach
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($rows->count() > 0)
                            @foreach($rows as $date => $row)
                            <tr>
                                @foreach($row as $key => $value)
                                <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                    @if ($key == 'date')
                                    <a href="{{ route('log-viewer::logs.show', [$date]) }}" class="btn btn-info">
                                        {{ $value }}
                                    </a>
                                    <span class="badge badge-primary"></span>
                                    @elseif ($value == 0)
                                    <span class="badge empty">{{ $value }}</span>
                                    @else
                                    <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                                        <span class="badge badge-level-{{ $key }}">{{ $value }}</span>
                                    </a>
                                    @endif
                                </td>
                                @endforeach
                                <td class="text-end">
                                    <a href="{{ route('log-viewer::logs.show', [$date]) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    <a href="{{ route('log-viewer::logs.download', [$date]) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-log-date="{{ $date }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="text-center">
                                    <span class="badge badge-secondary">{{ trans('log-viewer::general.empty-logs') }}</span>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    @lang('Total') {!! $rows->total() !!}
                </div>
            </div>
            <div class="col-5">
                <div class="float-end">
                    {!! $rows->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


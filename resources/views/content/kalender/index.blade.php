@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-body">
        <h6 class="mb-4 text-muted">Kalender Cuti 2023</h6>
        <div id='calendar'></div>

      </div>
    </div>
  </div>
</div>

@endsection
@section('page-script')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($cuti as $cut)
                {
                    title : '{{ $cut->employee->nama }}',
                    start : '{{ $cut->periode_awal }}',
                    end : '{{ $cut->periode_akhir }}',
                    textColor: 'white',
                    @if(now() > $cut->periode_akhir)
                      color: 'green',
                    @else
                      color: 'blue',
                    @endif
                },
                @endforeach
            ],
        })
    });
</script>
@endsection

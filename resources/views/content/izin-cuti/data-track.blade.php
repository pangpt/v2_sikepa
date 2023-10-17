          <div class="card-body">
            <ul class="timeline">
              <li class="{{App\Models\Leave_approval::where('status_approval', 1)->where('leave_id', $user)->count() > 0 ? 'active' : ''}}">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1 row">
                      <div class="col-9 mb-sm-0 mb-2">
                        <h6 class="mb-0">Disetujui Pejabat</h6>
                        <small class="text-muted">Dra. Hj. Heriyah, S.H., M.H.</small>
                      </div>
                      <div class="col-3 text-end">
                        @if (App\Models\Leave_approval::where('status_approval', 1)->where('leave_id', $user)->count() > 0)
                          <h6 class="mb-0">{{@(\Carbon\Carbon::parse(App\Models\Leave_approval::where('status_approval', 1)->where('leave_id', $user)->first()->tanggal_approval)->format('d F Y'))}}</h6>
                        @else
                          <h6 class="mb-0">-</h6>
                        @endif
                      </div>
                    </div>
                  </div>
              </li>
              <li class="{{App\Models\Leave_approval::where('status_approval', 2)->where('leave_id', $user)->count() > 0 ? 'active' : ''}}">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1 row">
                      <div class="col-9 mb-sm-0 mb-2">
                        <h6 class="mb-0">Disetujui Atasan Langsung</h6>
                        <small class="text-muted">{{$izinCuti->atasan->nama}}</small>
                      </div>
                      <div class="col-3 text-end">
                        @if (App\Models\Leave_approval::where('status_approval', 2)->where('leave_id', $user)->count() > 0)
                          <h6 class="mb-0">{{@(\Carbon\Carbon::parse(App\Models\Leave_approval::where('status_approval', 2)->where('leave_id', $user)->first()->tanggal_approval)->format('d F Y'))}}</h6>
                        @else
                          <h6 class="mb-0">-</h6>
                        @endif
                      </div>
                    </div>
                  </div>
              </li>
              <li class="{{App\Models\Leave_approval::where('status_approval', 3)->where('leave_id', $user)->count() > 0 ? 'active' : ''}}">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1 row">
                      <div class="col-9 mb-sm-0 mb-2">
                        <h6 class="mb-0">Verifikasi</h6>
                        <small class="text-muted">{{@$verifikator->employee->nama}}</small>
                      </div>
                      <div class="col-3 text-end">
                        @if (App\Models\Leave_approval::where('status_approval', 3)->where('leave_id', $user)->count() > 0)
                          <h6 class="mb-0">{{@(\Carbon\Carbon::parse(App\Models\Leave_approval::where('status_approval', 3)->where('leave_id', $user)->first()->tanggal_approval)->format('d F Y'))}}</h6>
                        @else
                          <h6 class="mb-0">-</h6>
                        @endif
                      </div>
                    </div>
                  </div>
              </li>
              <li class="{{App\Models\Leave_approval::where('status_approval', 4)->where('leave_id', $user)->count() > 0 ? 'active' : ''}}">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1 row">
                      <div class="col-9 mb-sm-0 mb-2">
                        <h6 class="mb-0">Pengajuan Cuti Diterima</h6>
                        <small class="text-muted">{{$izinCuti->employee->nama}}</small>
                      </div>
                      <div class="col-3 text-end">
                        @if (App\Models\Leave_approval::where('status_approval', 4)->where('leave_id', $user)->count() > 0)
                          <h6 class="mb-0">{{@(\Carbon\Carbon::parse(App\Models\Leave_approval::where('status_approval', 4)->where('leave_id', $user)->first()->tanggal_approval)->format('d F Y'))}}</h6>
                        @else
                          <h6 class="mb-0">-</h6>
                        @endif
                      </div>
                    </div>
                  </div>
              </li>
            </ul>
          </div>

@extends('template')
@section('aside')
    @include('partials.aside.dokter')
@endsection
@section('content')
<div>
    <h1>Dashboard Dokter</h1>
    <h2>Notifikasi Janji Temu</h2>
    <ul>
        @forelse($unreadNotifications as $notification)
            <li>
                <strong>{{ $notification->data["employee_name"] }}</strong>
                pada tanggal <strong>{{ \Carbon\Carbon::parse($notification->data["appointment_date"])->format('d-m-Y') }}</strong>
                dari <strong>{{ $notification->data["appointment_start_time"] }}</strong>
                sampai <strong>{{ $notification->data["appointment_end_time"] }}</strong>
                (<a href="{{ route('notifications.markAsRead', $notification->id) }}">Tandai sebagai dibaca</a>)
            </li>
        @empty
            <li>Tidak ada notifikasi belum dibaca</li>
        @endforelse
    </ul>

    <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
{{--                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->--}}
{{--                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>--}}
{{--                            </span>--}}
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                               Janji Temu Menunggu
                            </div>
                            <div class="text-muted">
                                {{$totalAppointmentMenunggu}}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
{{--                            <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->--}}
{{--                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" /></svg>--}}
{{--                            </span>--}}
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                               Janji Temu Belum Didiagnosa
                            </div>
                            <div class="text-muted">
                              {{$totalAppointmentBelumDidiagnosa}}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
{{--                            <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->--}}
{{--                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>--}}
{{--                            </span>--}}
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              Medical Check Up Menunggu
                            </div>
                            <div class="text-muted">
                              {{$totalMedicalCheckUpMenunggu}}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</div>
@endsection

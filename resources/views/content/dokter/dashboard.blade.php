@extends('template')

@section('aside')
    @include('partials.aside.dokter')
@endsection

@section('content')
<div>
    <h1>Dashboard Dokter</h1>
    <h2>Notifikasi Janji Temu</h2>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endif

    @if($unreadNotifications->isNotEmpty())
        <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Tandai Semua sebagai Dibaca</button>
        </form>
    @endif

    <ul class="list-unstyled mt-3">
        @forelse($unreadNotifications as $notification)
            <li class="mb-2">
                <strong>{{ $notification->data["employee_name"] }}</strong>
                pada tanggal <strong>{{ \Carbon\Carbon::parse($notification->data["appointment_date"])->format('d-m-Y') }}</strong>
                dari <strong>{{ $notification->data["appointment_start_time"] }}</strong>
                sampai <strong>{{ $notification->data["appointment_end_time"] }}</strong>
                (<a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-link">Tandai sebagai dibaca</a>)
            </li>
        @empty
            <li>Tidak ada notifikasi </li>
        @endforelse
    </ul>

    <div class="row row-cards mt-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            {{-- Icon can be added here --}}
                        </div>
                        <div>
                            <div class="font-weight-medium">
                                Janji Temu Menunggu
                            </div>
                            <div class="text-muted">
                                {{ $totalAppointmentMenunggu }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            {{-- Icon can be added here --}}
                        </div>
                        <div>
                            <div class="font-weight-medium">
                                Janji Temu Belum Didiagnosa
                            </div>
                            <div class="text-muted">
                                {{ $totalAppointmentBelumDidiagnosa }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            {{-- Icon can be added here --}}
                        </div>
                        <div>
                            <div class="font-weight-medium">
                                Medical Check Up Menunggu
                            </div>
                            <div class="text-muted">
                                {{ $totalMedicalCheckUpMenunggu }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

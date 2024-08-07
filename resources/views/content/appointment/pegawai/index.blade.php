@extends('template')

@section('aside')
    @include('partials.aside.pegawai')
@endsection

@section('content')
    <h2>Janji Temu</h2>
    <div class="div">
        <a href="{{ route('pegawai.myAppointment') }}" class="btn btn-secondary mb-3">Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Janji Temu</h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-muted">
                    Menampilkan
                    <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" value="{{$appointments->total()}}" size="3" aria-label="Jumlah janji temu">
                    </div>
                    data
                </div>
                <x-search-form
                    action="{{route('appointmentPegawai.search')}}"
                    placeholder="Cari nama dokter"
                    buttonText="Cari"
                    value="{{ request('search') }}"
                />
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal Janji Temu</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Nama Dokter</th>
                        <th>Catatan Janji Temu</th>
                        <th>Catatan Alergi Obat</th>
                        <th>Status</th>
                        <th>Diagnosa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $index => $appointment)
                        <tr>
                            <td><span class="text-muted">{{ $index + 1 }}</span></td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_start_time)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_end_time)->format('H:i') }}</td>
                            <td>{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }} {{ $appointment->doctor->speciality->name ?? '' }}</td>
                            <td>{{ $appointment->note }}</td>
                            <td>{{ $appointment->alergi_obat }}</td>
                            <td>
                                <span class="badge {{$appointment->status === 'pending' ? 'bg-warning':($appointment->status === 'approved' ? 'bg-success' :($appointment->status === 'rejected' ? 'bg-danger':'bg-secondary'))}} me-1">
                                        {{ $appointment->status == 'approved' ? 'Disetujui' : ($appointment->status == 'pending' ? 'Menunggu' : '') }}
                                    </span>
                            </td>
                            @if($appointment->diagnosed == true)
                                <td>
                                    <span class="badge bg-primary">Telah Didiagnosis</span>
                                    <a href="{{route('pegawai.myDiagnosisDetail', $appointment->id)}}" class="badge bg-secondary mx-3">Lihat Diagnosis</a>
                                </td>
                            @else
                                <td>
                                    <span class="badge bg-secondary">Belum Didagnosis</span>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada janji temu ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Tautan pagination -->
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">Menampilkan {{ $appointments->firstItem() }} hingga {{ $appointments->lastItem() }} dari {{ $appointments->total() }} data</p>
            {{ $appointments->links() }}
        </div>
    </div>
@endsection

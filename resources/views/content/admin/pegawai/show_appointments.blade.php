@extends('template')

@section('aside')
    @include('partials.aside.admin')
@endsection

@section('content')
<div class="container">
    <div class="col-12">
        <div class="d-flex mb-3">
            <a href="{{ route('pegawais.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Periksa {{ $employee->user->first_name }} {{ $employee->user->last_name }}</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Periksa</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Catatan</th>
                        <th>Diagnosa</th> <!-- Tambahkan kolom diagnosa -->
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($employee->appointments as $appointment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->appointment_start_time }}</td>
                            <td>{{ $appointment->appointment_end_time }}</td>
                            <td>{{ $appointment->note }}</td>
                            <td>
                                @forelse($appointment->diagnoses as $diagnose)
                                    <div>{{ $diagnose->diagnosa }}</div>
                                @empty
                                    Tidak ada diagnosa
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada riwayat periksa</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

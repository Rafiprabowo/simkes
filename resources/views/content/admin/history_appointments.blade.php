@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
 <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Janji Temu Pegawai</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Janji Temu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $index => $employee)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $employee->user->first_name }} {{ $employee->user->last_name }}</td>
                                <td>{{ $employee->appointments_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Data masih kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

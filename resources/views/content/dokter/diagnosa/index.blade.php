@extends('template')
@section('aside')
    @include('partials.aside.dokter')
@endsection
@section('content')
    <div class="col-12">
        <div class="col-lg-auto d-inline-block mb-3">
        <a href="{{route('doctor.dashboard')}}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Hasil Diagnosa</h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-muted">
                    Menampilkan
                    <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" value="{{$appointments->total()}}" size="3" aria-label="Invoices count">
                    </div>
                    data
                    </div>
                         <x-search-form
                            action="{{route('diagnosa.search')}}"
                            placeholder="Cari diagnosa"
                            buttonText="Cari"
                        />
                </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Janji Temu</th>
                        <th>Nama Pegawai</th>
                        <th>Hasil Diagnosa</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->employee->user->first_name }} {{ $appointment->employee->user->last_name }}</td>
                            <td>
                                <a href="{{route('detail.diagnosa', $appointment->id)}}">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
                   <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Menampilkan {{ $appointments->firstItem() }} hingga {{ $appointments->lastItem() }} dari {{ $appointments->total() }} data</p>
                {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection


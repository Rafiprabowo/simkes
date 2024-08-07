@extends('template')
@section('aside')
    @include('partials.aside.pegawai')
@endsection
@section('content')
    <div class="col-md-6">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                </div>
                <div>
                    {{ session('success') }}
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        <div class="mb-3">
            <a href="{{route('pegawai.myJadwal')}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Jadwal Check Up</h3>
        </div>

        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-muted">
                    Menampilkan
                    <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" value="{{$mcus->total()}}" size="3"
                               aria-label="Invoices count">
                    </div>
                    data
                </div>
                 <x-name-search
                        action="{{ route('myMcu.search') }}"
                        placeholder="cari nama dokter"
                        buttonText="Cari"
                    />
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Dokter</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                @forelse($mcus as $index => $mcu)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$mcu->date}}</td>
                        <td>{{$mcu->doctor->user->first_name}} {{$mcu->doctor->user->last_name}}
                            - {{$mcu->doctor->speciality->name}}</td>
                        <td class="{{$mcu->status == true ? 'text-green': 'text-red'}}">{{$mcu->status == true ? 'Sudah Check Up': 'Belum Check Up'}}</td>
                    </tr>
                @empty
                    <tr>
                        <td>Tidak ada data yang tersedia</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">Menampilkan {{ $mcus->firstItem() }} hingga {{ $mcus->lastItem() }}
                dari {{ $mcus->total() }} data</p>
            {{ $mcus->links() }}
        </div>
    </div>
@endsection

@extends('template')
@section('aside')
    @include('partials.aside.pegawai')
@endsection
@section('content')
    <div class="col-12">
        <div class="col-lg-auto d-inline-block mb-3">
        <a href="{{route('pegawai.myMedicalCheckUp')}}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Hasil Medical MCU</h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-muted">
                    Menampilkan
                    <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" value="{{$medicalCheckUps->total()}}" size="3" aria-label="Invoices count">
                    </div>
                    data
                </div>
                 <x-search-form
                        action="{{route('mcu.search')}}"
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
                                    <th>No Medical Check Up</th>
                                    <th>Nama Pegawai</th>
                                    <th>Nama Dokter</th>
                                    <th>Tanggal MCU</th>
                                    <th>Hasil MCU</th>
                        <th></th>
                    </tr>
                </thead>
                  <tbody>
                                @forelse($medicalCheckUps as $mcu)
                                    <tr>
                                        <td>{{$mcu->id}}</td>
                                        <td>{{$mcu->employee->user->first_name}} {{$mcu->employee->user->last_name}}</td>
                                        <td>{{$mcu->doctor->user->first_name}} {{$mcu->doctor->user->last_name}} {{$mcu->doctor->speciality->name}}</td>
                                        <td>{{$mcu->date}}</td>
                                        <td>
                                           @if($mcu->status == true)
                                                <a href="{{route('pegawai.showMyCheckUp', $mcu->id)}}" class="btn btn-secondary">Lihat Hasil</a>
                                            @else
                                                Hasil MCU belum keluar
                                            @endif
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
            </table>
                   <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Menampilkan {{ $medicalCheckUps->firstItem() }} hingga {{ $medicalCheckUps->lastItem() }} dari {{ $medicalCheckUps->total() }} data</p>
                {{ $medicalCheckUps->links() }}
        </div>
    </div>
</div>
@endsection


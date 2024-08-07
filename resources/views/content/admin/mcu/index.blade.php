@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
    <div class="col-12">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l5 5l10 -10" />
                </svg>
            </div>
            <div>
                {{ session('success') }}
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif

            <div class="d-flex">
                <div class="mb-3">
                <a href="{{route('buatCheckUpPegawai')}}" class="btn btn-primary">Buat Check Up Pegawai</a>
            </div>
            <div class="mx-3">
            <a href="{{route('admin.dashboard')}}" class="btn btn-secondary">Kembali</a>
        </div>
            </div>
                <div class="card">

                  <div class="card-header">
                    <h3 class="card-title">Data Jadwal Medical Check Up Pegawai</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-muted">
                        Menampilkan
                        <div class="mx-2 d-inline-block">
                            <input type="text" class="form-control form-control-sm" value="{{$mcus->total()}}"
                                   size="3" aria-label="Invoices count">
                        </div>
                        data
                    </div>
                    <x-name-search
                        action="{{ route('mcus.search') }}"
                        placeholder="cari nama"
                        buttonText="Cari"
                    />
                </div>
            </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Pegawai</th>
                            <th>Jenis Kelamin</th>
                            <th>Jadwal Check Up</th>
                          <th>Dokter </th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>

                      <tbody>
                      @forelse($mcus as $index => $mcu)
                          <tr>
                              <td>{{$index + 1}}</td>
                              <td>{{$mcu->employee->user->first_name}} {{$mcu->employee->user->last_name}}</td>
                              <td>{{$mcu->employee->gender}}</td>
                              <td>{{$mcu->date}}</td>
                              <td>{{$mcu->doctor->user->first_name}} {{$mcu->doctor->user->last_name}} {{$mcu->doctor->speciality->name}}</td>
                               <td class="{{$mcu->status == true ? 'text-green': 'text-red'}}">{{$mcu->status == true ? 'Sudah Check Up': 'Belum Check Up'}}</td>
                              <td>
                                  <div class="d-flex justify-content-start">
                                      <a href="{{route('editCheckUpPegawai', $mcu->id)}}" class="btn btn-secondary mx-2">Ubah</a>
                                  </div>
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td>Tidak ada data yang tersedia</td>
                          </tr>
                      @endforelse
                      </tbody>
                    </table>
                  </div>
{{--                     <div class="card-footer d-flex align-items-center">--}}
{{--                <p class="m-0 text-muted">Showing {{ $medicines->firstItem() }} to {{ $medicines->lastItem() }} of {{ $medicines->total() }} entries</p>--}}
{{--                {{ $medicines->links() }}--}}
{{--            </div>--}}
                </div>
              </div>
@endsection

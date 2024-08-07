@extends('template')
@section('aside')
    @include('partials.aside.dokter')
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
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="mx-3">
            <a href="{{route('doctor.dashboard')}}" class="btn btn-secondary mb-3">Kembali</a>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Buat Diagnosa Untuk Pegawai</h3>
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
                        action="{{route('appointment.search')}}"
                        placeholder="Cari janji temu"
                        buttonText="Cari"
                        value="{{ request('search') }}"
                    />
                    </div>
                  </div>
                  <div class="table-responsive">

                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th>ID Janji Temu</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Waktu Janji Temu</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($appointments as $index => $appointment)
                             <tr>
                                <td>{{ $appointment->id }}</td>
                                 <td>{{$appointment->employee->user->first_name}} {{$appointment->employee->user->last_name}}</td>
                                 <td>{{$appointment->employee->position}}</td>
                                 <td>{{\Illuminate\Support\Carbon::parse($appointment->date)->format('d/m/y')}}</td>

                                 <td>
                                     <div class="mb-3">
                                         <a href="{{route('diagnosa.edit', $appointment->id)}}" class="btn btn-primary">Buat Diagnosa</a>
                                     </div>
                                 </td>
                            </tr>
                        @empty
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                    <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Menampilkan {{ $appointments->firstItem() }} hingga {{ $appointments->lastItem() }} dari {{ $appointments->total() }} data</p>
                {{ $appointments->links() }}
                </div>
              </div>
            @endsection


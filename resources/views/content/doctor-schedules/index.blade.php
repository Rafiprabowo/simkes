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
            <div class="d-flex">
                <div class="mb-3">
                <a href="{{route('doctor-schedules.create')}}" class="btn btn-primary">Tambah Jadwal</a>
            </div>
            <div class="mx-3">
            <a href="{{route('doctor.dashboard')}}" class="btn btn-secondary">Kembali</a>
        </div>
            </div>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Data Jadwal</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                      <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" value="{{$schedules->total()}}" size="3" aria-label="Invoices count">
                        </div>
                        entries
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                      <tbody>
                      @forelse($schedules as $index => $schedule)
                           <tr>
                                    <td>{{$index + 1}}</td>
                                         <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                    <td>
                                        <span class="badge {{ $schedule->status === 'available' ? 'bg-success' : ($schedule->status === 'reserved' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                      <td>
                                  <div class="d-flex justify-content-start">
                                             <form action="{{ route('doctor-schedules.destroy', $schedule->id) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                             </form>
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
                     <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Showing {{ $schedules->firstItem() }} to {{ $schedules->lastItem() }} of {{ $schedules->total() }} entries</p>
                {{ $schedules->links() }}
            </div>
                </div>
              </div>
@endsection

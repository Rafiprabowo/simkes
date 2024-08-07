@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
    <div class="col-md-6">
        <div class="d-flex mb-3">
            <a href="/admin/" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('pemeriksaan-major.create') }}" class="btn btn-primary mx-3">Tambah pemeriksaan major</a>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icon-tabler-check">
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

        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemeriksaan Major</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($majors as $major)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $major->name }} </td>
                            <td>
                                <div class="d-flex">
                                    <div>
                                        <a href="{{route('pemeriksaan-major.edit', $major->id)}}"
                                           class="btn btn-secondary">Ubah</a>
                                    </div>
                                    <form action="{{ route('pemeriksaan-major.destroy', $major->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemeriksaan major ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-2">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada data pemeriksaan major</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
@endsection

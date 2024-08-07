@extends('template')

@section('aside')
    @include('partials.aside.admin')
@endsection

@section('content')
    <div class="col-12">
        <div class="d-flex mb-3">
            <a href="/admin/" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('dokters.create') }}" class="btn btn-primary mx-3">Tambah Dokter</a>
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
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <x-name-search
                        action="{{ route('doctors.search') }}"
                        placeholder="cari nama"
                        buttonText="Cari"
                    />
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Spesialisasi</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $doctor->user->first_name }}</td>
                                <td>{{ $doctor->user->last_name }}</td>
                                <td>{{ $doctor->user->username }}</td>
                                <td>{{ $doctor->user->email }}</td>
                                <td>{{ $doctor->speciality->name ?? '' }}</td>
                                <td>{{ $doctor->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $doctor->user->address }}</td>
                                <td>{{ $doctor->user->phone }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('dokters.edit', $doctor->user->id) }}" class="btn btn-secondary">Ubah</a>
                                        <form action="{{ route('dokters.destroy', $doctor->user->id) }}" method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mx-2">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">Tidak ada data dokter</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

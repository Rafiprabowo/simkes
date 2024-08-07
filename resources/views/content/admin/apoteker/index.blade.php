@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
    <div class="col-12">
        <div class="d-flex mb-3">
            <a href="/apoteker/" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('apotekers.create') }}" class="btn btn-primary mx-3">Tambah apoteker</a>
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
                    <div class="text-muted">
                        Menampilkan
                        <div class="mx-2 d-inline-block">
                            <input type="text" class="form-control form-control-sm" value="{{$pharmacists->total()}}"
                                   size="3" aria-label="Invoices count">
                        </div>
                        Data
                    </div>
                    <x-name-search
                        action="{{ route('pharmacies.search') }}"
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
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pharmacists as $pharmacist)
                        <tr>
                            <td>{{ $loop->iteration + $i }}</td>
                            <td>{{ $pharmacist->user->first_name }}</td>
                            <td>{{ $pharmacist->user->last_name }}</td>
                            <td>{{ $pharmacist->user->username }}</td>
                            <td>{{ $pharmacist->user->email }}</td>
                            <td>{{$pharmacist->gender}}</td>
                            <td>{{ $pharmacist->user->address }}</td>
                            <td>{{ $pharmacist->user->phone }}</td>
                            <td>
                                <div class="d-flex">
                                    <div>
                                    <a href="{{route('apotekers.edit', $pharmacist->id)}}" class="btn btn-secondary">Ubah</a>
                                </div>
                                <form action="{{ route('admins.destroy', $pharmacist->user->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus apoteker ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-2">Hapus</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada data apoteker</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">
                        Menampilkan {{ $pharmacists->firstItem() }} hingga {{ $pharmacists->lastItem() }}
                        dari {{ $pharmacists->total() }} data
                    </p>
                    {{ $pharmacists->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

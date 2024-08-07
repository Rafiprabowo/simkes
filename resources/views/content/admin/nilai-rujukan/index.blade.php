@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
    <div class="col-md-8">
        <div class="d-flex mb-3">
            <a href="/admin/" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('nilai-rujukans.create') }}" class="btn btn-primary mx-3">Buat Nilai Rujukan</a>
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
         @if($errors->any())
                <div class="alert alert-danger m-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="alert-title">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
          @endif
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemeriksaan Minor</th>
                        <th>Nilai laki-laki</th>
                        <th>Nilai perempuan</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($minors as $minor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $minor->name }} </td>
                            @foreach($minor->nilaiRujukan as $nilai)
                                @if($nilai->gender == "L")
                                <td>{{$nilai->reference_value}}</td>
                                @else
                                    <td>{{$nilai->reference_value}}</td>
                                @endif
                            @endforeach
                            @foreach($minor->nilaiRujukan as $satuan)
                                <td>{{$satuan->satuan}}</td>
                                @break
                            @endforeach
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('nilai-rujukans.edit', $minor->id)}}" class="btn btn-secondary">Ubah</a>
                                    <form action="{{ route('nilai-rujukans.destroy', $minor->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus nilai rujukan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-2">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada data pemeriksaan minor</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
@endsection

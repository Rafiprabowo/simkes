@extends('template')
@section('aside')
    @include('partials.aside.apoteker')
@endsection

@section('content')
    <div class="col-lg-8">
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
                    {{session('success')}}
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        <form class="card" action="{{route('kategori-obat.store')}}" method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Tambah kategori obat form</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Nama</label>
                    <div>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="nama kategori">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Deskripsi</label>
                    <div>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="deskripsi kategori">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{route('kategori-obat.index')}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary ">Simpan</button>
            </div>
        </form>
    </div>
@endsection

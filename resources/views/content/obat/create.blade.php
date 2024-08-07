@extends('template')
 @section('aside')
        @include('partials.aside.apoteker')
    @endsection
@section('content-header')
        @include('partials.content-header.obat.create')
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
                    {{session('success')}}
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        <form class="card" action="{{route('obat.store')}}" method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Tambah obat form</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Nama</label>
                    <div>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="nama obat">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Deskripsi</label>
                    <div>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="deskripsi obat">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pilih kategori</label>
                    <div>
                        <select class="form-select @error('categories_id') is-invalid @enderror" name="categories_id">

                            @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @empty
                                <option value="">-- Pilih kategori obat --</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Stok</label>
                    <div>
                        <input type="number" name="stok" class="form-control" placeholder="stok obat" required>
                    </div>
                </div>
            </div>


            <div class="card-footer d-flex justify-content-between">
                <a href="{{route('obat.index')}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary ">Simpan</button>
            </div>
        </form>
    </div>
@endsection

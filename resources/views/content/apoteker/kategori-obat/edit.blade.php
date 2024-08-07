@extends('template')

@section('aside')
    @include('partials.aside.apoteker')
@endsection

@section('content')
    <div class="col-lg-8">
        <form class="card" action="{{ route('kategori-obat.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h3 class="card-title">Ubah Kategori Obat</h3>
            </div>
            <div class="card-body">
                <!-- Display all errors here -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Name Field -->
                <div class="mb-3">
                    <label class="form-label required">Nama</label>
                    <div>
                        <input
                            name="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}"
                            required
                            placeholder="Nama kategori">
                    </div>
                </div>

                <!-- Description Field -->
                <div class="mb-3">
                    <label class="form-label required">Deskripsi</label>
                    <div>
                        <input
                            type="text"
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            value="{{ old('description', $category->description) }}"
                            required
                            placeholder="Deskripsi kategori">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('kategori-obat.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection

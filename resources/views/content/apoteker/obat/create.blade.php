@extends('template')

@section('aside')
    @include('partials.aside.apoteker')
@endsection

@section('content')
    <div class="col-lg-8">
        <form class="card" action="{{ route('obat.store') }}" method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Tambah Obat</h3>
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
                            class="form-control "
                            value="{{ old('name') }}"
                            placeholder="Nama Obat">
                    </div>
                </div>

                <!-- Description Field -->
                <div class="mb-3">
                    <label class="form-label required">Deskripsi</label>
                    <div>
                        <input
                            type="text"
                            name="description"
                            class="form-control "
                            value="{{ old('description') }}"
                            placeholder="Deskripsi Obat">
                    </div>
                </div>
                 <div class="mb-3">
                    <label class="form-label">Pilih kategori</label>
                    <div>
                        <select class="form-select " name="category_id">

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
                        <input type="number" name="stock" class="form-control" placeholder="stock obat" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Satuan</label>
                    <div>
                        <input
                            type="text"
                            name="satuan"
                            class="form-control "
                            value="{{ old('satuan') }}"
                            placeholder="Satuan Obat">
                    </div>
                </div>

            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection

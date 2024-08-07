@extends('template')

@section('aside')
    @include('partials.aside.apoteker')
@endsection

@section('content')
    <div class="col-lg-8">
        <form class="card" action="{{ route('obat.update', $medicine->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h3 class="card-title">Ubah Data Obat</h3>
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
                            value="{{ old('name', $medicine->name) }}"
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
                            class="form-control @error('description') is-invalid @enderror"
                            value="{{ old('description', $medicine->description) }}"
                            placeholder="Deskripsi Obat">

                    </div>
                </div>

                <!-- Category Field -->
                <div class="mb-3">
                    <label class="form-label required">Pilih kategori</label>
                    <div>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $medicine->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <!-- Stock Field -->
                <div class="mb-3">
                    <label class="form-label required">Stok</label>
                    <div>
                        <input
                            type="number"
                            name="stock"
                            class="form-control @error('stock') is-invalid @enderror"
                            value="{{ old('stock', $medicine->stock) }}"
                            placeholder="Stock Obat">

                    </div>
                </div>
                 <div class="mb-3">
                    <label class="form-label required">Satuan</label>
                    <div>
                        <input
                            type="text"
                            name="satuan"
                            class="form-control "
                            value="{{ old('satuan', $medicine->satuan) }}"
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

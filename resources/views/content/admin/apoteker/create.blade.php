@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
    <div class="col-md-6">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <a href="{{route('apotekers.index')}}" class="btn btn-secondary mb-3">Kembali</a>
              <form class="card" action="{{route('apotekers.store')}}" method="post">
                  @csrf
                <div class="card-header">
                  <h3 class="card-title">Tambah Apoteker</h3>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Buat akun apoteker</h3>
                    <hr>
                  <x-create-user-form />
                     <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="gender">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
@endsection

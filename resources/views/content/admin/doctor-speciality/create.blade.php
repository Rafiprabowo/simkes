@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
<div class="col-md-3">
     @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="card" action="{{route('specialities.store')}}" method="post">
                  @csrf
                <div class="card-header">
                  <h3 class="card-title">Tambah Spesialisasi Dokter</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Spesialisasi</label>
                        <input type="text" name="name" class="form-control" required placeholder="nama spesialisasi" >
                    </div>
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
</div>
@endsection

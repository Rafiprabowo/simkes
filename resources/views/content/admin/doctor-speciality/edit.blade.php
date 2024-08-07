@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
<div class="col-md-3">
        <form class="card" action="{{route('specialities.update', $speciality->id)}}" method="post">
                  @csrf
            @method('PUT')
                <div class="card-header">
                  <h3 class="card-title">Ubah Data Spesialisasi Dokter</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Spesialisasi</label>
                        <input type="text" name="name" class="form-control" required  value="{{$speciality->name}}">
                    </div>
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
</div>
@endsection

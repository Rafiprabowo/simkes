@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
<div class="col-md-3">
        <form class="card" action="{{route('pemeriksaan-major.update', $major->id)}}" method="post">
                  @csrf
            @method('PUT')
                <div class="card-header">
                  <h3 class="card-title">Ubah Pemeriksaan Major</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Pemeriksaan Major</label>
                        <input type="text" name="name" class="form-control" required  value="{{$major->name}}">
                    </div>
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
</div>
@endsection

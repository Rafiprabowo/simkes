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
        <form class="card" action="{{route('nilai-rujukans.store')}}" method="post">
                  @csrf
                <div class="card-header">
                  <h3 class="card-title">Buat Nilai Rujukan</h3>
                </div>
                <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label">Pilih pemeriksaan minor</label>
                    <select name="id_pemeriksaan_minor" class="form-select">
                        @forelse($minors as $minor)
                            <option value="{{$minor->id}}">{{$minor->name}}</option>
                        @empty
                            <option value="">--Tidak ada data--</option>
                        @endforelse
                    </select>
                </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai Laki-laki</label>
                        <input type="text" class="form-control" name="l">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nilai perempuan</label>
                        <input type="text" class="form-control" name="p">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Satuan</label>
                        <input type="text" class="form-control" name="satuan">
                    </div>
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
</div>
@endsection

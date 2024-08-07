@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
<div class="col-md-3">
        <form class="card" action="{{route('pemeriksaan-minor.update', $minor->id)}}" method="post">
                  @csrf
            @method('PUT')
                <div class="card-header">
                  <h3 class="card-title">Tambah Pemeriksaan Minor</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama pemeriksaan minor</label>
                        <input type="text" name="name" class="form-control" required  placeholder="nama pemeriksaan minor" value="{{$minor->name}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apakah berorientasi pada jenis kelamain ?</label>
                        <label for="" class="form-label">ya</label>
                        <input type="radio" name="is_gender_oriented" value="1" {{$minor->is_gender_oriented == true ? 'checked': ''}} >
                         <label for="" class="form-label">tidak</label>
                        <input type="radio" name="is_gender_oriented" value="0" {{$minor->is_gender_oriented == false ? 'checked': ''}}>
                    </div>
                    <div class="mb-3">
                        <label for="form-label">Pilih kategori pemeriksaan major</label>
                        <select name="id_pemeriksaan_major" class="form-select">

                            @forelse($pemeriksaanMajors as $majors)
                                <option value="{{$majors->id}}" {{old('id_pemeriksaan_major', $minor->id_pemeriksaan_major) == $majors->id ? 'selected': ''}}>{{$majors->name}}</option>
                            @empty
                                <option value="">--tidak ada data nama pemeriksaan major--</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
</div>
@endsection

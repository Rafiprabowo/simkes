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
        <form class="card" action="{{route('nilai-rujukans.update', $minor->id)}}" method="post">
                  @csrf
            @method('PUT')
                <div class="card-header">
                  <h3 class="card-title">Ubah Nilai Rujukan</h3>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Nama pemeriksaan minor : {{$minor->name}}</h3>
                    <input type="hidden" name="id_pemeriksaan_minor" value="{{$minor->id}}">
                    @foreach($minor->nilaiRujukan as $nilai)
                        <div class="mb-3">
                            @if($nilai->gender == "L")
                                <label for="" class="form-label">Nilai rujukan laki-laki</label>
                            <input type="text" name="l" class="form-control" value="{{$nilai->reference_value}}">
                            @else
                                <label for="" class="form-label">Nilai rujukan perempuan</label>
                                <input type="text" name="p" class="form-control" value="{{$nilai->reference_value}}">
                            @endif
                        </div>
                    @endforeach
                    @foreach($minor->nilaiRujukan as $satuan)
                        <label for="" class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" value="{{$satuan->satuan}}">
                                @break
                            @endforeach
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
</div>
@endsection

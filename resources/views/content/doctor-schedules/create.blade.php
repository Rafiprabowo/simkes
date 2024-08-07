@extends('template')
@section('aside')
    @include('partials.aside.dokter')
@endsection
@section('content')

    <h2>Tambah Jadwal Dokter</h2>
    <div class="div">
        <a href="{{route('doctor-schedules.index')}}" class="btn btn-secondary mb-3">Kembali</a>
    </div>
    @if($errors->has('conflict'))
                <div class="alert alert-danger mb-3 ">
                    {{ $errors->first('conflict') }}
                </div>
            @endif
    <form class="card" action="{{route('doctor-schedules.store')}}" method="post">
        @csrf
        <div class="card-body">
            <input type="hidden" name="doctor_id" value="{{$user->doctor->id}}">
            <small class="form-hint mb-3 text-red">Durasi setiap appointment adalah 20 menit</small>
            <div class="mb-3">
                <label class="form-label ">Tanggal</label>
                <div>
                    <input type="datetime-local" class="form-control" id="date" name="start_time">
                    <small class="form-hint">Require date</small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection


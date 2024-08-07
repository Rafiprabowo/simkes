@extends('template')

@section('aside')
    @include('partials.aside.admin')
@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l5 5l10 -10" />
                </svg>
            </div>
            <div>
                {{ session('success') }}
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endif

<div class="col-md-6">
    <form class="card" action="{{ route('storeMcu') }}" method="post">
        @csrf
        <div class="card-header">
            <h3 class="card-title">Buat Jadwal Check Up Pegawai</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Pilih Pegawai</label>
                <div>
                    @foreach($employees as $employee)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="id_employees[]" value="{{ $employee->id }}" id="employee-{{ $employee->id }}">
                            <label class="form-check-label" for="employee-{{ $employee->id }}">
                                {{ $employee->user->first_name }} {{ $employee->user->last_name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih Dokter</label>
                <div>
                    <select class="form-select" name="id_doctor">
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                {{ $doctor->user->first_name }} {{ $doctor->user->last_name }} - {{ $doctor->speciality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="date" class="form-control">
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>


@endsection

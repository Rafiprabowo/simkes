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
        <form class="card" action="{{ route('updateCheckUpPegawai', $mcu->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h3 class="card-title">Ubah Jadwal MCU</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama Pegawai</label>
                    <div>
                        <select class="form-select" name="id_employee" readonly="">
                            <option value="{{$mcu->employee->id}}">{{$mcu->employee->user->first_name}} {{$mcu->employee->user->first_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Dokter</label>
                    <div>
                        <select class="form-select" name="id_doctor" readonly="">
                                <option value="{{ $mcu->doctor->id }}">
                                    {{ $mcu->doctor->user->first_name }} {{ $mcu->doctor->user->last_name }} - {{ $mcu->doctor->speciality->name }}
                                </option>

                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control" value="{{$mcu->date}}">
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

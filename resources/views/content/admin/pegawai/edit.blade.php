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
        <a href="{{route('pegawais.index')}}" class="btn btn-secondary mb-3">Kembali</a>
        <form class="card" action="{{route('pegawais.update', $employee->user->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h3 class="card-title">Ubah Data Pegawai</h3>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Nama depan</label>
                    <input type="text" value="{{$employee->user->first_name}}" id="first_name" name="first_name"
                           class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama belakang</label>
                    <input type="text" value="{{$employee->user->last_name}}" id="last_name" name="last_name"
                           class="form-control" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" value="{{$employee->user->username}}" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" value="{{$employee->user->email}}" id="email" name="email" class="form-control" required>
            </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" value="{{$employee->user->address}}" id="address" name="address"
                           class="form-control"
                           required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Hp</label>
                    <input type="text" value="{{$employee->user->phone}}" id="phone" name="phone" class="form-control"
                           required>
                </div>
                <hr>
                <h3 class="card-title">Biodata Pegawai</h3>
                <div class="mb-3">
                    <label for="position" class="form-label">Posisi</label>
                    <input type="text" class="form-control" id="position" name="position"
                           value="{{ old('position', $employee->position) }}" required>
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                           value="{{ old('date_of_birth', $employee->date_of_birth ? $employee->date_of_birth : '') }}"
                           required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="L" {{ old('gender', $employee->gender) == 'L' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="P" {{ old('gender', $employee->gender) == 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="medical_history" class="form-label">Riwayat Medis</label>
                    <textarea class="form-control" id="medical_history"
                              name="medical_history">{{ old('medical_history', $employee->medical_history) }}</textarea>
                </div>
                <hr>
                <h3 class="card-title">Kontak Darurat</h3>
                <div class="mb-3">
                    <label for="emergency_contact_name" class="form-label">Nama Kontak Darurat</label>
                    <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name"
                           value="{{ old('emergency_contact_name', $employee->emergency_contact_name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="emergency_contact_number" class="form-label">Nomor Kontak Darurat</label>
                    <input type="text" class="form-control" id="emergency_contact_number"
                           name="emergency_contact_number"
                           value="{{ old('emergency_contact_number', $employee->emergency_contact_number) }}" required>
                </div>
                <div class="mb-3">
                    <label for="emergency_contact_relationship" class="form-label">Hubungan dengan Kontak
                        Darurat</label>
                    <input type="text" class="form-control" id="emergency_contact_relationship"
                           name="emergency_contact_relationship"
                           value="{{ old('emergency_contact_relationship', $employee->emergency_contact_relationship) }}"
                           required>
                </div>
                <div class="mb-3">
                    <label for="emergency_contact_address" class="form-label">Alamat Kontak Darurat</label>
                    <textarea class="form-control" id="emergency_contact_address" name="emergency_contact_address"
                              required>{{ old('emergency_contact_address', $employee->emergency_contact_address) }}</textarea>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

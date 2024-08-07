@extends('template')
@section('aside')
    @include('partials.aside.pegawai')
@endsection

@section('content')
    <div class="col-lg-8">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                </div>
                <div>
                    {{ session('success') }}
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01m-6.38 -5h12.76l-6.38 11.38z" /></svg>
                </div>
                <div>
                    {{ session('error') }}
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
            <a href="{{ route('pegawai.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
        <div class="row row-cards">

            <div class="col-12">
                <form class="card" id="updateProfileEmployee" action="{{ route('updateProfileEmployee') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <h3 class="card-title">Profil Pegawai</h3>
                        <hr>
                        <div class="row row-cards">
                            <h3>Biodata pegawai</h3>
                            <input type="hidden" id="employee_id" name="employee_id" value="{{ $user->employee->id }}">
                            <div class="col-sm-6 ">
                                <div class="mb-3">
                                    <label class="form-label">Nama depan</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->first_name }}">
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="mb-3">
                                    <label class="form-label">Nama akhir</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->last_name }}">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No Hp</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal lahir</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ $user->employee->date_of_birth ?? '' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="gender" name="gender" disabled>
                                        <option value="">--Pilih jenis kelamin--</option>
                                        <option value="L" {{ $user->employee->gender == "L" ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ $user->employee->gender == "P" ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" id="position" name="position" class="form-control" value="{{ $user->employee->position }}" disabled>
                                </div>
                            </div>
                            <hr>
                            <h3>Kontak darurat</h3>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama kontak darurat</label>
                                    <input type="text" value="{{ $user->employee->emergency_contact_name }}" name="emergency_contact_name" class="form-control" placeholder="nama kontak darurat" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Hubungan dengan kontak darurat</label>
                                    <input type="text" value="{{ $user->employee->emergency_contact_relationship }}" name="emergency_contact_relationship" class="form-control" placeholder="hubungan dengan kontak darurat" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor kontak darurat</label>
                                    <input type="text" value="{{ $user->employee->emergency_contact_number }}" name="emergency_contact_number" class="form-control" placeholder="nomor kontak darurat" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Alamat kontak darurat</label>
                                    <input type="text" value="{{ $user->employee->emergency_contact_address }}" name="emergency_contact_address" class="form-control" placeholder="nomor kontak darurat" disabled>
                                </div>
                            </div>
                             <div class="col-md-12">
                         <div class="mb-3 mb-0">
                <label class="form-label">Riwayat Penyakit yang dimiliki</label>
                <textarea name="medical_history" rows="5" class="form-control" placeholder="Riwayat Penyakit" disabled>{{$user->employee->medical_history}}</textarea>
            </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Tambahkan script yang diperlukan jika ada
    </script>
@endsection

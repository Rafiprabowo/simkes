@extends('template')

@section('aside')
    @include('partials.aside.admin')
@endsection

@section('content')
    <div class="col-lg-8">
        @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    </div>
                    <div>
                        {{session('success')}}
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
        @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    </div>
                    <div>
                        {{session('error')}}
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
        @endif
            <form class="card" action="{{ route('admin.updateRole') }}" method="post">
        @csrf
        <div class="card-header">
            <h3 class="card-title">Ubah role user</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Pilih user</label>
                <select class="form-control form-select" name="id" id="select-user">
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        @if($user->role !== "admin")
                            <option value="{{ $user->id }}" data-role="{{ $user->role }}">
                                {{ $user->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih role</label>
                <select class="form-control form-select" name="role">
                    <option value="">-- Pilih role --</option>
                    <option value="admin" id="role-admin">Admin</option>
                    <option value="pegawai" id="role-pegawai">Pegawai</option>
                    <option value="dokter" id="role-dokter">Dokter</option>
                    <option value="apoteker" id="role-apoteker">Apoteker</option>
                </select>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function() {
    // Fungsi untuk mengganti pilihan role sesuai dengan user yang dipilih
    $('#select-user').change(function() {
        var selectedUser = $(this).find('option:selected');
        var userRole = selectedUser.data('role');

        if(userRole) {
            $('select[name="role"]').val(userRole);
        } else {
            $('select[name="role"]').val('');
        }
    });
});
    </script>
@endsection

@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form action="{{route('apotekers.update', $apoteker->user->id)}}" method="post" class="card">
        @csrf
        @method('PUT')
        <div class="card-header">
                  <h3 class="card-title">Ubah Data Apoteker</h3>
                </div>
        <div class="card-body">
        <div class="mb-3">
        <label class="form-label">Nama depan</label>
        <input type="text" value="{{$apoteker->user->first_name}}" id="first_name" name="first_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama belakang</label>
        <input type="text" value="{{$apoteker->user->last_name}}" id="last_name" name="last_name" class="form-control" required>
    </div>
             <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" value="{{$apoteker->user->username}}" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" value="{{$apoteker->user->email}}" id="email" name="email" class="form-control" required>
            </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" value="{{$apoteker->user->address}}" id="address" name="address" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No Hp</label>
        <input type="text" value="{{$apoteker->user->phone}}" id="phone" name="phone" class="form-control" required>
    </div>
        <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="gender" >
                        <option value="L" {{$apoteker->gender == "L" ? 'selected' : ''}}>Laki-laki</option>
                        <option value="P" {{$apoteker->gender == "P" ? 'selected' : ''}}>Perempuan</option>
                    </select>
                </div>
        <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </div>
    </form>

@endsection

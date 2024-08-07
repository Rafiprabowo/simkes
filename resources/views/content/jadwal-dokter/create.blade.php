@extends('template')
@section('aside')
    @include('partials.aside.dokter')
@endsection
@section('content-header')
    @include('partials.content-header.jadwal-dokter.create')
@endsection
@section('content')
    <div class="col-md-6">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                </div>
                <div>
                    {{session('success')}}
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        @if($errors->any())
                <div class="alert alert-danger m-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="alert-title">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
          @endif
       <form class="card" action="{{ route('schedule.store') }}" method="post">
    @csrf
    <div class="card-header">
        <h3 class="card-title">Tambah jadwal</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
        <label class="form-label">Pilih Tanggal & Waktu</label>
            <div>
            <input type="datetime-local" class="form-fieldset" name="available_time" required>
            @error('available_time')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
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
    </script>
@endsection



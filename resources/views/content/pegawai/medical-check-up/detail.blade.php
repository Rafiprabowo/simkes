@extends('template')
@section('aside')
    @include('partials.aside.pegawai')
@endsection
@section('content')
    <a href="{{route('pegawai.dashboard')}}" class="btn btn-secondary">Kembali</a>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card card-lg">
                <div class="card-body markdown">
                    <h2>Hasil Medical Check Up Pegawai</h2>
                    <hr>
                    <h3>Nama : {{$medicalCheckUps->employee->user->first_name}} {{$medicalCheckUps->employee->user->last_name}}</h3>
                    <h3>Jabatan : {{$medicalCheckUps->employee->position}}</h3>
                    <h3>Tanggal Lahir : {{$medicalCheckUps->employee->date_of_birth}}</h3>
                    <h3>Jenis Kelamin : {{$medicalCheckUps->employee->gender}}</h3>
                    <hr>
                    <h3>Medical Check Up ID : {{$medicalCheckUps->id}}</h3>
                    <h3>Tanggal Medical Check Up :  {{ \Carbon\Carbon::parse($medicalCheckUps->date)->format('d/m/y H:i') }}</h3>
                    <hr>
                    <h3>Nama Dokter : {{$medicalCheckUps->doctor->user->first_name}} {{$medicalCheckUps->doctor->user->last_name}} </h3>
                    <h3>Spesialisasi : {{$medicalCheckUps->doctor->speciality->name}}</h3>
                    <hr>

                    <h3>Hasil Medical Check Up</h3>
                     @foreach($medicalCheckUps->pemeriksaanMinors as $index => $pemeriksaanMinor)
                         <table class="table-responsive">
                             <thead>
                                <tr>
                                 <th>No</th>
                                 <th>Nama Pemeriksaan Umum</th>
                                 <th>Kategori Pemeriksaan</th>
                                 <th>Hasil</th>
                                 <th>Nilai Normal</th>
                                 <th>Satuan</th>
                             </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$pemeriksaanMinor->name}}</td>
                                    <td>{{$pemeriksaanMinor->pemeriksaanMajor->name}}</td>
                                    <td>{{$pemeriksaanMinor->pivot->result}}</td>
                                    <td>@foreach($pemeriksaanMinor->nilaiRujukan as $nilai)
                                            <li>{{$nilai->gender }} : {{$nilai->reference_value}}</li>
                                    @endforeach</td>
                                    <td>@foreach($pemeriksaanMinor->nilaiRujukan as $nilai)
                                            <li> {{$nilai->satuan }} </li>
                                    @endforeach</td>
                                </tr>
                             </tbody>

                         </table>
                     @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

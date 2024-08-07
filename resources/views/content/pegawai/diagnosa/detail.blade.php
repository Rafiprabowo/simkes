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
                    <h1>Hasil Diagnosa {{$user->first_name.' '.$user->last_name}}</h1>
                    <hr>
                      <h3>ID Janji Temu : {{$appointment->id}}</h3>
                    <h3>Tanggal Janji Temu :  {{ \Carbon\Carbon::parse($appointment->appointment_start_time)->format('d/m/y H:i') }}</h3>
                    <h3>Catatan Janji Temu : {{$appointment->note}}</h3>
                    <h3>Catatan Alergi Obat : {{$appointment->alergi_obat}}</h3>
                    <hr>
                    <h3>Nama Dokter : {{$appointment->doctor->user->first_name}} {{$appointment->doctor->user->last_name}} </h3>
                    <h3>Spesialisasi : {{$appointment->doctor->speciality->name}}</h3>
                    <hr>
                    <h2>Hasil Diagnosa</h2>
                    <hr>
                     @php
                        $firstDiagnosis = $appointment->diagnoses->first();
                    @endphp
                    <h3>Hasil Diagnosa Penyakit : {{ $firstDiagnosis->diagnosa }}</h3>
                    <h3>Resep : </h3>
                     <table class="table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Deskripsi Obat</th>
                                <th>Kategori Obat</th>
                                <th>Satuan Obat</th>
                                <th>Jumlah</th>
                                <th>Dosis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointment->diagnoses as $diagnosis)
                                @foreach($diagnosis->medicines as $index => $medicine )
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$medicine->name}}</td>
                                        <td>{{$medicine->description}}</td>
                                        <td>{{$medicine->categories->name}}</td>
                                        <td>{{$medicine->satuan}}</td>
                                        <td>{{$medicine->pivot->jumlah}}</td>
                                        <td>{{$medicine->pivot->dosis_obat}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

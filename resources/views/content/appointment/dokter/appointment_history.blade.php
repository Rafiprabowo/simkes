@extends('template')
@section('aside')
    @include('partials.aside.dokter')
@endsection
@section('content')
    <div class="col-12">
        <div class="col-lg-auto d-inline-block mb-3">
        <a href="{{route('doctor.dashboard')}}" class="btn btn-secondary">Kembali</a>
    </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Appointments</h3>
            </div>
            <div class="table-responsive">
                <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Appointment Date</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Nama Dokter</th>
                        <th>Catatan Appointment</th>
                        <th>Catatan Alergi Obat</th>
                        <th>Status</th>
                        <th>Sudah Didiagnosa </th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($user->doctor->appointments as $index => $appointment)
                        <tr>
                                <td><span class="text-muted">{{$index + 1}}</span></td>
                                <td>{{$appointment->employee->user->first_name}} {{$appointment->employee->user->last_name}}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_start_time)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_end_time)->format('H:i') }}</td>
                                <td>{{$user->first_name}} {{$user->last_name}} {{$user->doctor->speciality->name ?? ''}}</td>
                                <td>{{$appointment->note}}</td>
                                <td>{{$appointment->alergi_obat}}</td>
                                <td>

                                </td>


                                 <td class="text-end">
                                        <span class="dropdown">
                                          <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                          <div class="dropdown-menu">
                                              @if($appointment->status === "approved")
                                              @elseif($appointment->status === "pending")
                                                  <a href="{{route('approve-appointment', $appointment->id)}}" id="approve" class="dropdown-item">Approve</a>
                                              @endif
                                          </div>
                                        </span>
                                </td>
                            </tr>
                    @empty
                        <tr>
                            <td>data tidak tersedia</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function (){
             var token = $("meta[name='csrf-token']").attr("content");
            $('#approve').click(function (){
                $.ajax({
                    url:$(this).attr('href'),
                    type: 'GET',
                    success: function (response){
                        if(response.success){
                            location.reload()
                            alert('Appointment approved successfully!')
                        }else {
                            alert('Failed to approve appointment')
                        }
                    },
                    error:function (xhr){
                        alert('An error occured: ' + xhr.responseText)
                    }
                });
            });
            $('#cancel').click(function (){
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'GET',
                    success: function (response){
                        if(response.success){
                            location.reload()
                            alert('Appointment cancelled successfully!')
                        }else {
                            alert('Failed to cancel appointment')
                        }
                    },
                    error: function (xhr){
                        alert('An error occured: ' + xhr.responseText)
                    }
                })
            })
            $('#delete').click(function(){
                let appointmentId = $(this).data('id')
                if(confirm('Are you sure want to delete this appointment?')){
                    $.ajax({
                        url:'/api/delete-appointment/'+appointmentId,
                        type:'DELETE',
                        data:{
                            _token:'{{csrf_token()}}'
                        },
                        success:function (response){
                            if(response.success){
                                location.reload()
                                alert('Appopintment deleted successfully!')
                            }else {
                                alert('Failed to delete appointment')
                            }
                        },
                        error: function (xhr){
                            alert('An error occured : ' + xhr.responseText)
                        }

                    })
                }
            })
        });
    </script>
@endsection

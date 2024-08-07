@extends('template')
    @section('aside')
        @include('partials.aside.dokter')
    @endsection
    @section('content-header')
        @include('partials.content-header.jadwal-dokter.index')
    @endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Jadwal dokter</h3>
            </div>
            <div class="card-body border-bottom py-3">
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($schedules) > 0)
                        @foreach($schedules as $index => $schedule)
                            <tr>
                                <td><span class="text-muted">{{$index + 1}}</span></td>
                                <td><a href="#" class="text-reset" tabindex="-1">{{$schedule->available_time ?? ''}}</a></td>
                                <td>
                                    <span class="badge {{$schedule->is_available ?? $schedule->is_available == true ? 'bg-success' :($schedule->is_available?? $schedule->is_available == false ? 'bg-danger':'bg-warning') }}  me-1">
                                        @if($schedule->is_available)
                                            Jadwal tersedia
                                        @else
                                            Jadwal tidak tersedia
                                        @endif
                                    </span>
                                </td>
                                <td >
                                        <span class="dropdown">
                                          <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                          <div class="dropdown-menu ">
                                              <a id="delete" class="dropdown-item dropdown-item-text" data-id="{{$schedule->id}}">Delete</a>
                                          </div>
                                        </span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>data tidak tersedia</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function (){

            {{--$('#delete').click(function(){--}}
            {{--    var appointmentId = $(this).data('id')--}}
            {{--    if(confirm('Are you sure wanto delete this appointment?')){--}}
            {{--        $.ajax({--}}
            {{--            url:'/api/delete-appointment/'+appointmentId,--}}
            {{--            type:'DELETE',--}}
            {{--            data:{--}}
            {{--                _token:'{{csrf_token()}}'--}}
            {{--            },--}}
            {{--            success:function (response){--}}
            {{--                if(response.success){--}}
            {{--                    location.reload()--}}
            {{--                    alert('Appopintment deleted successfully!')--}}
            {{--                }else {--}}
            {{--                    alert('Failed to delete appointment')--}}
            {{--                }--}}
            {{--            },--}}
            {{--            error: function (xhr){--}}
            {{--                alert('An error occured : ' + xhr.responseText)--}}
            {{--            }--}}

            {{--        })--}}
            {{--    }--}}
            {{--})--}}
        });
    </script>
@endsection




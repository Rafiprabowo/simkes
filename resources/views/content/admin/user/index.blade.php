@extends('template')
@section('aside')
    @include('partials.aside.admin')
@endsection
@section('content')
    <div class="col-12">
                <div class="card">
                  <div class="table-responsive">
                    <table
		class="table table-vcenter card-table">
                      <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                        </tr>
                      </thead>
                      <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->first_name}} </td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <th>{{$user->password}}</th>
                                    <td>
                                        @if($user->role === "admin")
                                            ID Admin  : {{$user->admin->id}}
                                        @elseif($user->role === "dokter")
                                           ID Dokter : {{$user->doctor->id}}
                                        @elseif($user->role === "apoteker")
                                            ID apoteker : {{$user->pharmacist->id}}
                                        @elseif($user->role === "pegawai")
                                            ID pegawai : {{$user->employee->id}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
@endsection

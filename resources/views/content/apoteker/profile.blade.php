@extends('template')
@section('aside')
    @include('partials.aside.apoteker')
@endsection
@section('content')
<div class="col-lg-8">
              <div class="row row-cards">
                <div class="col-12">
                  <form class="card">
                    <div class="card-body">
                      <h3 class="card-title">Profile</h3>
                      <div class="row row-cards">
                                <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Nama depan</label>
                            <input type="text" class="form-control" value="{{$user->first_name}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Nama belakang</label>
                            <input type="text" class="form-control" value="{{$user->last_name}}" disabled >
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="{{$user->username}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" value="{{$user->email}}"  disabled>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control"
									       value="{{$user->address}}" disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

@endsection

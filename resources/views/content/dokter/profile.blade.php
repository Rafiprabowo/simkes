@extends('template')
@section('aside')
    @include('partials.aside.dokter')
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
        @endif
              <div class="row row-cards">
                <div class="col-12">
                  <form class="card" action="{{route('profile.update')}}" method="post">
                      @csrf
                    <div class="card-body">
                      <h3 class="card-title">Profile dokter</h3>
                      <div class="row row-cards">
                          <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="Company" disabled value="{{$user->first_name}}">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" disabled value="{{$user->last_name}}">
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="Company" disabled
									       value="{{$user->username}}">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">No Hp</label>
                            <input type="text" class="form-control" placeholder="Username" disabled value="{{$user->phone}}">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" placeholder="Email" disabled value="{{$user->email}}">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" placeholder="Home Address"
									       value="{{$user->address}}" disabled>
                          </div>
                        </div>
                        <div>
                            <div class="mb-3">
                        <label for="position" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{$user->doctor->gender }}" disabled required>
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Spesialisasi</label>
                              <h3 class="text-xl-start">{{$user->doctor->speciality->name ?? '' }}</h3>
                                <div>
{{--                                <a href="#" id="new-specialization" class="btn">--}}
{{--                                Set new spesialisasi--}}
{{--                                </a>--}}
{{--                                </div>--}}
                        </div>
{{--                                    <div id="specialization-select-container" style="display:none;">--}}
{{--                    <select class="form-select mb-7" name="speciality_id">--}}
{{--                        <option value="">-- Pilih spesialisasi --</option>--}}
{{--                        @foreach($specializations as $specialization)--}}
{{--                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                      </div>
                    </div>

                    </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>

@endsection

{{--@section('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--    $('#new-specialization').click(function(event) {--}}
{{--        event.preventDefault();--}}
{{--        $('#specialization-select-container').toggle(); // Menampilkan/menyembunyikan select--}}
{{--    });--}}
{{--});--}}

{{--    </script>--}}
{{--@endsection--}}

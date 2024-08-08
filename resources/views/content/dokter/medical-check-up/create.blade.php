@extends('template')
@section('aside')
    @include('partials.aside.dokter')
@endsection
@section('content')

    <input type="hidden" id="id_doctor" value="{{\Illuminate\Support\Facades\Auth::user()->doctor->id}}" >
     <input type="hidden" id="medical_check_ups_id" name="medical_check_ups_id">
    <div class="col-lg-auto d-inline-block mb-3 mt-3 ">
        <a id="submit-all" href="#" class="btn btn-primary">Simpan semua data</a>
    </div>
    <div class="col-lg-auto d-inline-block mx-3">
        <a href="{{route('doctor.dashboard')}}" class="btn btn-secondary">Kembali</a>
    </div>
            <div class="col-lg-auto">
                 @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                <div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#tabs-profile-7" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                          Profile</a>
                      </li>
                      <li class="nav-item">
                        <a href="#tabs-activity-7" class="nav-link " data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/activity -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h4l3 8l4 -16l3 8h4" /></svg>
                          MCU</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="tabs-profile-7">
                        <label class="form-label">Pilih Pegawai</label>
                         <select name="id_employee" id="select-employee" class="form-select mb-3">

                         </select>
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Profile pegawai</h3>
                            </div>
                            <div class="card-body">
                                <input id="employee_id" name="employee_id" type="hidden">
                              <div class="mb-3">
                                <label class="form-label ">Nama</label>
                                <div>
                                  <input id="name" type="text" class="form-control" disabled>
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Alamat</label>
                                <div>
                                  <input id="address" type="text" class="form-control" disabled>
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">No Hp</label>
                                <div>
                                  <input id="phone" type="text" class="form-control" disabled>
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Jabatan</label>
                                <div>
                                  <input id="position" type="email" class="form-control" disabled>
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Jenis Kelamin</label>
                                <div>
                                  <input id="gender" type="text" class="form-control" disabled>
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Umur</label>
                                <div>
                                  <input id="age" type="text" class="form-control" disabled>
                                </div>
                              </div>
                            </div>

                          </div>
                      </div>
                      <div class="tab-pane fade" id="tabs-activity-7">
                            <div class="mb-3">
                                <label class="form-label">Tambah Pemeriksaan</label>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-report">
                                Input Pemeriksaan
                                </a>
                            </div>
                            <div class="card">
                                  <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                      <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Pemeriksaan Major</th>
                                            <th>Nilai</th>
                                            <th>Nilai Rujukan </th>
                                          <th>Proses</th>
                                        </tr>
                                      </thead>
                                      <tbody id="list-pemeriksaan-minor">

                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                            <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Pemeriksaan Minor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="card">
                                      <div class="table-responsive">
                                        <table
                            class="table table-vcenter card-table">
                                          <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Pemeriksaan Minor</th>
                                              <th>Kategori Pemeriksaan</th>
                                              <th>Gender Oriented</th>
                                              <th></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @forelse($pemeriksaanMinors as $index => $minor)
                                                <tr>
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{$minor->name}}</td>
                                                    <td>{{$minor->pemeriksaanMajor->name}}</td>
                                                    <td>{{$minor->is_gender_oriented == true ? 'Ya' : 'Tidak'}}</td>
                                                    <td>
                                                        <a data-id="{{$minor->id}}" class="add-pemeriksaan-minor btn btn-primary"  >
                                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                                            Tambah
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>Tidak ada data pemeriksaan minor</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>

                                                    </td>
                                                </tr>
                                            @endforelse
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  <div class="modal-footer">
                                    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                      Simpan
                                    </a>
                                  </div>
                                </div>
                              </div>
                           </div>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>

@endsection
@section('script')
    <script>
        $(document).ready(function (){
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            let pemeriksaanData = {};
            fetchAllEmployee()


            $('#select-employee').on('change', function(){
            let employeeId = $(this).val();
            fetchGetEmployeeById(employeeId);
             let selectedOption = $(this).find('option:selected');
                let medicalCheckUpId = selectedOption.data('mcuid');
                $('#medical_check_ups_id').val(medicalCheckUpId);
            });

            // Event listener for adding pemeriksaan minor
            $('.add-pemeriksaan-minor').click(function(event) {
                event.preventDefault();
                let minorId = $(this).data('id');
                fetchGetPemeriksaanMinorById(minorId);
            });

             // Event listener for input changes on dynamically added fields
            $('#list-pemeriksaan-minor').on('input', '.nilai-pemeriksaan', function () {
                let id = $(this).data('id');
                let value = $(this).val();
                pemeriksaanData[id] = value; // Update the value in the object
            });

             // Remove row and delete from pemeriksaanData
            $('#list-pemeriksaan-minor').on('click', '.remove-minor', function () {
                let id = $(this).data('id');
                $(`tr[data-id="${id}"]`).remove();
                delete pemeriksaanData[id]; // Remove from the object
            });


           // Submit all data
            $('#submit-all').click(function (e) {
                e.preventDefault();
                if (confirm('Apakah anda yakin ingin menyimpan data medical check up semuanya ?')) {
                    let id_employee = $('#select-employee').val();
                    let id_doctor = $('#id_doctor').val();
                    let medical_check_ups_id = $('#medical_check_ups_id').val(); // Adjust how you retrieve medical_check_ups_id

                    // Convert pemeriksaanData to array of objects
                    let pemeriksaanArray = Object.keys(pemeriksaanData).map(id => ({
                        id: id,
                        nilai: pemeriksaanData[id]
                    }));

                    // Send data to the server
                    $.ajax({
                        url: '/api/submit-all-pemeriksaan',
                        type: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            id_employee: id_employee,
                            id_doctor: id_doctor,
                            medical_check_ups_id: medical_check_ups_id, // Ensure this is correct
                            pemeriksaanData: pemeriksaanArray
                        }),
                        success: function(response) {
                            if (response.status === 'success') {
                                alert('Data berhasil disimpan');
                                $('#list-pemeriksaan-minor').empty();
                                pemeriksaanData = {}; // Reset the data object
                                window.location.href='{{route('medical-check-up.index')}}'
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Request failed:', status, error);
                            alert('Terjadi kesalahan sistem.');
                        }
                    });
                }
            });

            // Fetch data for pemeriksaan minor by ID
            function fetchGetPemeriksaanMinorById(minorId) {
                $.ajax({
                    url: '/api/fetch-pemeriksaan-minor/' + minorId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if(response.status === 'success' && response.data) {
                            let listPemeriksaanMinor = $('#list-pemeriksaan-minor');

                            // Check if the minorId already exists in the table
                            if (listPemeriksaanMinor.find(`tr[data-id="${response.data.id}"]`).length === 0) {
                                // Append the new row if not exists
                                listPemeriksaanMinor.append(
                                    `<tr data-id="${response.data.id}">
                                        <td>${response.data.name}</td>
                                        <td>${response.data.pemeriksaanMajor}</td>
                                        <td>
                                            <input type="text" id="nilai-${response.data.id}" class="form-control nilai-pemeriksaan" data-id="${response.data.id}">
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                ${response.data.nilai_rujukan.map(item => `<li class="list-group-item">${item.gender} : ${item.reference_value}</li>`).join('')}
                                            </ul>
                                        </td>
                                        <td>
                                            <a data-id="${response.data.id}" class="remove-minor btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>`
                                );

                                // Add to pemeriksaanData object
                                pemeriksaanData[response.data.id] = '';
                            } else {
                                alert('Pemeriksaan minor sudah ada di daftar.');
                            }
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed:', status, error);
                        alert('Terjadi kesalahan sistem.');
                    }
                });
            }
        });

            function fetchAllEmployee() {
                    $.ajax({
                        url: '{{ route('fetch-all-employee') }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.success && response.data.length > 0) {
                                alert('Ada jadwal pemeriksaan MCU baru');
                                let selectEmployee = $('#select-employee');
                                selectEmployee.empty();
                                selectEmployee.html('<option value="">--Pilih Pegawai--</option>');
                                $.each(response.data, function(key, employee) {
                                    selectEmployee.append(
                                        `<option value="${employee.id}" data-mcuid="${employee.medical_check_up_id}">${employee.name}</option>`
                                    );
                                });
                            } else {
                                alert('Tidak ada jadwal check up pegawai');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Request failed:', status, error);
                            alert('Tidak ada jadwal check up pegawai.');
                        }
                    });
                }

            function fetchGetEmployeeById(employeeId){
                    $.ajax({
                        url: '/api/fetch-employee/' + employeeId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            console.log(response);
                            if(response.success && response.data){
                            $('#employee_id').val(response.data.id)
                            $('#name').val(response.data.name);
                            $('#address').val(response.data.address);
                            $('#phone').val(response.data.phone);
                            $('#position').val(response.data.position);
                            $('#gender').val(response.data.gender);
                            $('#age').val(response.data.age);
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error){
                            console.error('Request failed:', status, error);
                            alert('Terjadi kesalahan sistem.');
                        }
                    });
                }
    </script>
@endsection

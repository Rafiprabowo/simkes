@extends('template')
@section('aside')
    @include('partials.aside.dokter')
@endsection
@section('content')
    <input type="hidden" id="appointment_id" value="{{$appointment->id}}">
            <input type="hidden" id="doctor_id" value="{{\Illuminate\Support\Facades\Auth::user()->doctor->id}}" >
          <input type="hidden" id="employee_id" value="{{$appointment->employee->id}}" >

    <h1>Halaman Diagnosa</h1>
    <div class="col-lg-auto d-inline-block mb-3 mt-3 ">
        <a id="submit-all" href="#" class="btn btn-primary">Simpan semua datadiagnosa</a>
    </div>
    <div class="col-lg-auto d-inline-block mx-3">
        <a href="{{route('doctor.dashboard')}}" class="btn btn-secondary">Kembali</a>
    </div>
            <div class="col-lg-auto">
                <div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#tabs-profile-7" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                          Profile</a>
                      </li>
                        <li class="nav-item">
                        <a href="#tabs-home-8" class="nav-link" data-bs-toggle="tab">Kontak Darurat</a>
                      </li>
                      <li class="nav-item">
                        <a href="#tabs-activity-7" class="nav-link " data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/activity -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h4l3 8l4 -16l3 8h4" /></svg>
                          Diagnosa</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="tabs-profile-7">
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Profile pegawai</h3>
                            </div>
                            <div class="card-body">
                                <input id="employee_id" name="employee_id" type="hidden">
                              <div class="mb-3">
                                <label class="form-label ">Nama</label>
                                <div>
                                  <input id="name" type="text" class="form-control" value="{{$appointment->employee->user->first_name.' '.$appointment->employee->user->first_name}}">
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Alamat</label>
                                <div>
                                  <input id="address" type="text" class="form-control" value="{{$appointment->employee->user->address}}">
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">No Hp</label>
                                <div>
                                  <input id="phone" type="text" class="form-control" value="{{$appointment->employee->user->phone}}">
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Jabatan</label>
                                <div>
                                  <input id="position" type="email" class="form-control" value="{{$appointment->employee->position}}">
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Jenis Kelamin</label>
                                <div>
                                  <input id="gender" type="text" class="form-control" value="{{$appointment->employee->gender}}">
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Umur</label>
                                <div>
                                  <input id="age" type="text" class="form-control" value="{{$appointment->employee->age}}">
                                </div>
                              </div>
                            </div>

                          </div>
                      </div>
                        <div class="tab-pane fade" id="tabs-home-8">
                            <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Kontak Darurat</h3>
                            </div>
                            <div class="card-body">
                              <div class="mb-3">
                                <label class="form-label ">Nama</label>
                                <div>
                                  <input  type="text" class="form-control" value="{{$appointment->employee->emergency_contact_name}}">
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Hubungan</label>
                                <div>
                                  <input type="text" class="form-control" value="{{$appointment->employee->emergency_contact_relationship}}">
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">No Hp</label>
                                <div>
                                  <input type="text" class="form-control" value="{{$appointment->employee->emergency_contact_number}}">
                                </div>
                              </div>
                                <div class="mb-3">
                                <label class="form-label ">Alamat</label>
                                <div>
                                  <input type="text" class="form-control" value="{{$appointment->employee->emergency_contact_address}}">
                                </div>
                              </div>
                            </div>
                          </div>
                       </div>
                      <div class="tab-pane fade" id="tabs-activity-7">
                            <div class="mb-3">
                                <h1 class="card-title">Buat Diagnosa</h1>
                            </div>
                          <div class="row row-card">
                              <div class="card">
                                  <div class="card-body">
                                      <h3 class="card-title">Keluhan</h3>
                                      <p>{{$appointment->note ?? ''}}</p>
                                      <h3 class="card-title">Catatan Diagnosa</h3>
                                      <div class="mb-3 mb-0">
                                        <textarea rows="5" class="form-control" id="catatan-diagnosa" placeholder="Catatan diagnosa untuk pasien"></textarea>
                                        </div>
                                      <div class="mb-3">
                                          <h3 class="card-title">Catatan Alergi Obat Pasien</h3>
                                          <ul>
                                              <li>{{$appointment->alergi_obat ?? ''}}</li>
                                          </ul>
                                      </div>
                                      <div class="mb-3">
                                <label class="form-label">Tambah Obat</label>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-report">
                                Input obat
                                </a>
                            </div>
                                    <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                      <thead>
                                        <tr>
                                            <th>ID Obat</th>
                                            <th>Nama Obat</th>
                                            <th>Kategori Obat</th>
                                            <th>Dosis</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Jumlah</th>
                                            <th>Proses</th>
                                        </tr>
                                      </thead>
                                      <tbody id="list-medicines">

                                      </tbody>
                                    </table>
                                  </div>
                                  </div>
                                 <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Daftar Obat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <!-- Search Input -->
                                                        <div class="mb-3">
                                                            <input type="text" id="search-medicine" class="form-control" placeholder="Cari obat berdasarkan nama atau deskripsi">
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-vcenter card-table" id="medicine-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Obat</th>
                                                                        <th>Kategori Obat</th>
                                                                        <th>Deskripsi Obat</th>
                                                                        <th>Satuan</th>
                                                                        <th>Jumlah</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @forelse($medicines as $index => $medicine)
                                                                        <tr>
                                                                            <td>{{$index + 1}}</td>
                                                                            <td class="medicine-name">{{$medicine->name}}</td>
                                                                            <td>{{$medicine->categories->name}}</td>
                                                                            <td class="medicine-description">{{$medicine->description}}</td>
                                                                            <td>{{$medicine->satuan }}</td>
                                                                            <td>
                                                                                <input type="number" class="form-control jumlah-obat" data-id="{{$medicine->id}}" data-stock="{{$medicine->stock}}" min="1" max="{{$medicine->stock}}">
                                                                            </td>
                                                                            <td>
                                                                                <a data-id="{{$medicine->id}}" class="tambah-obat btn btn-primary">Tambah</a>
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        <tr>
                                                                            <td colspan="6">Tidak ada data obat</td>
                                                                        </tr>
                                                                    @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
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
            </div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $('#search-medicine').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();

            $('#medicine-table tbody tr').filter(function () {
                var name = $(this).find('.medicine-name').text().toLowerCase();
                var description = $(this).find('.medicine-description').text().toLowerCase();

                $(this).toggle(name.includes(searchTerm) || description.includes(searchTerm));
            });
        });

        let dataResep = {};

        // Event handler for adding medicine
        $('.tambah-obat').click(function (event) {
            event.preventDefault();
            let medicine_id = $(this).data('id');
            let jumlah_obat = $(`input[data-id="${medicine_id}"]`).val();
            let stok_tersedia = $(`input[data-id="${medicine_id}"]`).data('stock');

            // Validate stock
            if (jumlah_obat > stok_tersedia) {
                alert('Jumlah obat yang diminta melebihi stok tersedia.');
                return;
            }

            fetchObatById(medicine_id, jumlah_obat);
        });

         // Function to update dosis in dataResep
        function updateDosis(id) {
            let dosis = $(`#dosis-${id}`).val();
            let satuan = $(`#satuan-${id}`).val();
            let frekuensi = $(`#frekuensi-${id}`).val();
            if (!dataResep[id]) {
                dataResep[id] = {};
            }
            dataResep[id].dosis = `${dosis} ${satuan}, ${frekuensi}`;
        }
        // Event handler for input changes in dosis
        $('#list-medicines').on('input', '.dosis-obat', function () {
            let id = $(this).data('id');
            updateDosis(id);
        });
        // Event handler for input changes in satuan
        $('#list-medicines').on('input', '.satuan-obat', function () {
            let id = $(this).data('id');
            updateDosis(id);
        });
        // Event handler for input changes in frekuensi
        $('#list-medicines').on('change', '.frekuensi-obat', function () {
            let id = $(this).data('id');
            updateDosis(id);
        });


        // Event handler for removing medicine
        $('#list-medicines').on('click', '.remove-medicine', function () {
            let id = $(this).data('id');
            $(`tr[data-id="${id}"]`).remove();
            delete dataResep[id];
        });

        // Event handler for submitting all data
        $('#submit-all').click(function (e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menyimpan semua data?')) {
                let employee_id = $('#employee_id').val();
                let doctor_id = $('#doctor_id').val();
                let appointment_id = $('#appointment_id').val();
                let diagnosa = $('#catatan-diagnosa').val();

                // Validate diagnosa
                if (!diagnosa) {
                    alert('Catatan diagnosa field is required.');
                    return;
                }

                // Convert dataResep to array of objects
                let dataResepArray = Object.keys(dataResep).map(id => ({
                    id: id,
                    dosis: dataResep[id].dosis,
                    jumlah: dataResep[id].jumlah
                }));

                // Send data to the server
                $.ajax({
                    url: '/api/submit-all-resep',
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        appointment_id: appointment_id,
                        employee_id: employee_id,
                        doctor_id: doctor_id,
                        diagnosa: diagnosa,
                        dataResep: dataResepArray
                    }),
                    success: function (response) {
                        if (response.status === 'success') {
                            alert('Data berhasil disimpan');
                            $('#list-medicines').empty();
                            $('#catatan-diagnosa').val('');
                            dataResep = {};
                            sessionStorage.setItem('successMessage', response.message);
                            window.location.href = '{{route('diagnosa.index')}}';
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.message;
                            let errorMessages = '';
                            $.each(errors, function (key, value) {
                                errorMessages += value[0] + '\n';
                            });
                            alert(errorMessages);
                        } else {
                            console.log(xhr); // Log full error response
                            alert('Terjadi kesalahan saat membuat janji temu');
                        }
                    }
                });
            }
        });

        // Function to fetch medicine data by ID
        function fetchObatById(obatID, jumlahObat) {
            $.ajax({
                url: '/api/fetch-medicine/' + obatID,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success' && response.data) {
                        let listMedicines = $('#list-medicines');

                        if (listMedicines.find(`tr[data-id="${response.data.id}"]`).length === 0) {
                            listMedicines.append(
                                `<tr data-id="${response.data.id}">
                                    <td>${response.data.id}</td>
                                    <td>${response.data.name}</td>
                                    <td>${response.data.category}</td>
                                    <td>
                                        <input type="text" id="dosis-${response.data.id}" class="form-control dosis-obat" data-id="${response.data.id}" value="1">
                                    </td>
                                    <td>
                                         <input type="text" id="satuan-${response.data.id}" class="form-control text-muted satuan-obat" data-id="${response.data.id}" value="${response.data.satuan}" readonly>
                                    </td>
                                    <td colspan="2">
                                         <select id="frekuensi-${response.data.id}" class="form-select frekuensi-obat" data-id="${response.data.id}">
                                            <option value="sehari sekali">Sehari sekali</option>
                                            <option value="dua kali sehari">Dua kali sehari</option>
                                            <option value="tiga kali sehari">Tiga kali sehari</option>
                                            <option value="empat kali sehari">Empat kali sehari</option>
                                            <option value="lima kali sehari">Lima kali sehari</option>
                                         </select>
                                    </td>
                                    <td>${jumlahObat}</td>
                                    <td>
                                        <a data-id="${response.data.id}" class="remove-medicine btn btn-danger">Hapus</a>
                                    </td>
                                </tr>`
                            );

                                   // Initialize dataResep
                            dataResep[response.data.id] = {
                                jumlah: jumlahObat,
                                dosis: '1',
                                satuan: response.data.satuan,
                                frekuensi: 'sehari sekali'
                            };
                            updateDosis(response.data.id); // Initialize the dosis value
                        } else {
                            alert('Obat already exists.');
                        }
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Request failed:', status, error);
                    alert('Terjadi kesalahan');
                }
            });
        }
    });
</script>
@endsection



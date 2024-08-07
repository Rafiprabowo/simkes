@extends('template')
@section('aside')
        @include('partials.aside.apoteker')
    @endsection
@section('content-header')
    @include('partials.content-header.obat.index')
@endsection
@section('content')
<div class="col-12">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-check">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l5 5l10 -10" />
            </svg>
        </div>
        <div>
            {{ session('success') }}
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
    @endif
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($medicines as $index => $medicine)
                      <tr>
                        <td data-label="No">{{ $index + 1 }}</td>
                        <td data-label="Name" id="name-{{ $medicine->id }}">{{ $medicine->name }}</td>
                        <td data-label="Deskripsi" id="description-{{ $medicine->id }}">{{ $medicine->description }}</td>
                        <td data-label="Kategori" id="category-{{$medicine->id}}">{{ $medicine->categories->name ?? '' }}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="#" data-id="{{ $medicine->id }}" class="btn button-edit" data-bs-target="#modal-edit-obat" data-bs-toggle="modal">Edit</a>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item delete-dropdown"  href="#" data-id="{{$medicine->id}}" data-bs-target="#modal-delete" data-bs-toggle="modal">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>Data obat masih kosong</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-edit-obat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Obat</h5>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" id="modal-new-name" class="form-control ">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" id="modal-new-description" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select id="select-categories" class="form-select ">

                        @forelse($categories as $category)
                        <option class="categories" value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                             <option value="">--Pilih kategori obat--</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                <a href="#" id="button-update" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Update</a>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="modal-title">Are you sure?</div>
            <div>If you proceed, you will lose all your personal data.</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
            <button type="button" id="button-delete" class="btn btn-danger" data-bs-dismiss="modal">Yes, delete all my data</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
    var obatId;
    var token   = $("meta[name='csrf-token']").attr("content");
    // Edit button click handler
    $('.button-edit').on('click', function(event) {
        event.preventDefault(); // Prevent the default behavior
        obatId = $(this).data('id');
        $.ajax({
            url: '/api/medicine/' + obatId,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                $('#modal-new-name').val(result.medicine.name);
                $('#modal-new-description').val(result.medicine.description);
                if(result.medicine.categories_id){
                    $('#select-categories').val(result.medicine.categories_id)
                }
            }
        });
    });

    // Update button click handler
    $('#button-update').on('click', function(event) {
    event.preventDefault();
    $.ajax({
        url: '/api/updateMedicine',
        type: 'POST',
        dataType: 'json',
        data: {
            medicine_id: obatId,
            new_name: $('#modal-new-name').val(),
            new_description: $('#modal-new-description').val(),
            new_category_id: $('#select-categories').val(),
            _token: token // Ensure to pass the CSRF token
        },
        success: function(result) {
            $(`#name-${result.medicine.id}`).text(result.medicine.name);
            $(`#description-${result.medicine.id}`).text(result.medicine.description);
            $(`#category-${result.medicine.id}`).text(result.category_name);

            $('#modal-edit-obat').modal('hide');
            alert('Medicine updated successfully');
        },
        error: function(xhr) {
        if(xhr.status === 422) {
          let errors = xhr.responseJSON.message;
          let errorMessages = '';
          $.each(errors, function(key, value) {
            errorMessages += value[0] + '\n'; // value[0] karena biasanya error disimpan sebagai array
          });
          alert(errorMessages)
        }
      }
    });
});

    $(document).on('click', '.delete-dropdown', function(event) {
        event.preventDefault();
        var medicineId = $(this).data('id'); // Get the medicine ID from the button data
        $('#button-delete').data('medicine-id', medicineId); // Pass the medicine ID to the confirm button
    });

    $('#button-delete').on('click', function(event) {
        event.preventDefault();
        var medicineId = $(this).data('medicine-id'); // Retrieve the medicine ID

        $.ajax({
            url: '/api/delete-medicine',
            type: 'POST',
            dataType: 'json',
            data: {
                medicine_id: medicineId,
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                // Remove the row from the table
                $(`#name-${medicineId}`).closest('tr').remove();
                // Optionally, you can show a success alert or message here
                alert('Medicine deleted successfully');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert('Failed to delete');
            }
        });
    });

});

</script>
@endsection

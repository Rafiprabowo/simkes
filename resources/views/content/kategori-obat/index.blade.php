@extends('template')

@section('aside')
        @include('partials.aside.apoteker')
@endsection
@section('content-header')
    @include('partials.content-header.kategori-obat.index')
@endsection

@section('content')
<div class="col-12">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($categories as $index => $category)
                    <tr>
                                <td data-label="No">{{ $index + 1 }}</td>
                                <td data-label="Name" id="name-{{ $category->id }}">{{ $category->name }}</td>
                                <td class="text-muted" id="description-{{ $category->id }}" data-label="Deskripsi">{{ $category->description }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="#" data-id="{{ $category->id }}" class="btn button-edit" data-bs-toggle="modal" data-bs-target="#modal-edit-kategori">
                                            Edit
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item delete-dropdown" data-id="{{$category->id}}" href="#" data-bs-target="#modal-delete" data-bs-toggle="modal">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                @empty
                    <tr>
                        <td>
                            Data kategori masih kosong
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-edit-kategori" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" id="modal-new-name" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" id="modal-new-description" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a href="#" id="button-update" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                    Update
                </a>
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
        $(document).ready(function () {
            var kategoriId;
            var token = $("meta[name='csrf-token']").attr("content");
            $('.button-edit').on('click', function () {
                kategoriId = $(this).attr('data-id');
                $.ajax({
                    url: "/api/fetch-medicine-category/" + kategoriId,
                    type: "GET",
                    dataType: 'json',
                    success: function (result) {
                        $('#modal-new-name').val(result.medicineCategories.name);
                        $('#modal-new-description').val(result.medicineCategories.description);
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Something went wrong');
                    }
                });
            });

            $('#button-update').on('click', function (event) {
                event.preventDefault();
                var newName = $('#modal-new-name').val();
                var newDescription = $('#modal-new-description').val();

                $.ajax({
                    url: '/api/update-medicine-categories',
                    type: 'POST',
                    data: {
                        category_id: kategoriId,
                        new_name: newName,
                        new_description: newDescription,
                        _token: token
                    },
                    dataType: 'json',
                    success: function (result) {
                        $(`#name-${kategoriId}`).text(result.medicineCategory.name);
                        $(`#description-${kategoriId}`).text(result.medicineCategory.description);
                        alert('Category updated successfully');
                    },
                    error: function (xhr) {
                       if(xhr.status === 422){
                           let errors = xhr.responseJSON.message;
                           let errorMessages = '';
                           $.each(errors, function (key, value){
                               errorMessages += value[0] + '\n';
                           })
                           alert(errorMessages)
                       }
                    }
                });
            });

            $(document).on('click', '.delete-dropdown', function(event) {
        event.preventDefault();
        var categoryId = $(this).data('id'); // Get the medicine ID from the button data
        $('#button-delete').data('category-id', categoryId); // Pass the medicine ID to the confirm button
    });

            $('#button-delete').on('click', function(event) {
        event.preventDefault();
        var categoryId = $(this).data('category-id'); // Retrieve the medicine ID

        $.ajax({
            url: '/api/delete-medicine-category',
            type: 'POST',
            dataType: 'json',
            data: {
                category_id: categoryId,
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                // Remove the row from the table
                $(`#name-${categoryId}`).closest('tr').remove();
                // Optionally, you can show a success alert or message here
                alert('Category deleted successfully');
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

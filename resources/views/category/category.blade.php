@extends('layouts.admin.default')
@section('content')
    <div class="container  mt-4">


        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">List Category</h5>
                <div class="d-flex align-items-center gap-2 ms-auto">
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#Addmodel">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="dropdown">
                            Download
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('category.export', ['type' => 'excel']) }}">Excel </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('category.export', ['type' => 'pdf']) }}"> PDF </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>


        <div class="modal fade" id="Addmodel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('categories') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="category" id="" value="true">

                        <div class="modal-header">
                            <h5 class="modal-title">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col">
                                    <label for="name" class="form-label">Category</label>
                                    <input type="text" name="name" id="name" placeholder="Category"
                                        class="form-control" required>
                                </div>

                                <div class="col">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" name="description" id="description" class="form-control"
                                        placeholder="Description">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-floppy-disk">
                                </i> Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editstatusmodel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('categories') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="edit_status" value="true">

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label d-block">Status</label>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="status" id="edit_status_active" value="active"
                                            class="form-check-input" checked>
                                        <label for="edit_status_active" class="form-check-label">
                                            Active
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="status" id="edit_status_inactive" value="inactive"
                                            class="form-check-input">
                                        <label for="edit_status_inactive" class="form-check-label">
                                            Inactive
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-pen">

                                </i> Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editmodel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('categories') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="edit_category" value="true">

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col">
                                    <label for="name" class="form-label">Category</label>
                                    <input type="text" name="name" id="edit_name" placeholder="Category"
                                        class="form-control" required>
                                </div>

                                <div class="col">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" name="description" id="edit_description" class="form-control"
                                        placeholder="Description">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-pen">

                                </i> Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.datatable')

    <script>
        $(document).ready(function() {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        width: '20%',
                    },
                    {
                        data: 'description',
                        name: 'description',
                        width: '30%',
                        render: function(data, type, row) {
                            return data ? data : "-";
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        width: '30%',
                        render: function(data, type, row) {

                            if (data === 'active') {
                                return '<span class="badge bg-success">Active</span>';
                            } else {
                                return '<span class="badge bg-secondary">Inactive</span>';
                            }

                        }
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center'
                    }
                ]
            });

            $(document).on('click', '.editRow', function(e) {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('categories') }}",
                    method: "GET",
                    dataType: "json",
                    data: {
                        id: id,
                        get_category: true,
                    },
                    success: function(data) {
                        $('#edit_id').val(data.id);
                        $('#edit_name').val(data.name);
                        $('#edit_description').val(data.description);
                        $('#editmodel').modal("show");
                    }
                })
            });


            $(document).on('click', '.editStatusRow', function(e) {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('categories') }}",
                    method: "GET",
                    dataType: "json",
                    data: {
                        id: id,
                        get_status: true,
                    },
                    success: function(data) {
                        $('#edit_id').val(data.id);

                        if (data.status === 'active') {
                            $('#edit_status_active').prop('checked', true);
                        } else {
                            $('#edit_status_inactive').prop('checked', true);
                        }

                        $('#editstatusmodel').modal("show");
                    }
                });
            });


            $(document).on('click', '.deleteRow', function() {

                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('categories') }}",
                    type: "DELETE",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}",
                        delete_cate: true,
                    },
                    success: function(data) {
                        $('#modalMessage').text("Delete Successfully");
                        var modal = new bootstrap.Modal(document.getElementById(
                            'sessionModal'));
                        modal.show();
                        $('#sessionModal').on('hidden.bs.modal', function() {
                            $('#datatable').DataTable().ajax.reload();
                        });
                    },
                    error: function() {
                        $("#modalMessage").text("Something went wrong!");
                        var modal = new bootstrap.Modal(document.getElementById(
                            'sessionModal'));
                        modal.show();
                    }

                });

            });
        });
    </script>
@endsection

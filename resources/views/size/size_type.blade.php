@extends('layouts.admin.default')
@section('content')
    <div class="container mt-4">

        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">List Size</h5>
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#Addmodel">
                    <i class="fa-solid fa-plus"></i> Add New
                </a>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Size Type</th>

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
                    <form action="{{ route('size_type') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="size_list" value="true">

                        <div class="modal-header">
                            <h5 class="modal-title">Add Size</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label for="size_type" class="form-label">Size</label>
                                    <input type="text" name="size_type" id="size_type" placeholder="size"
                                        class="form-control" required>
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



        <div class="modal fade" id="editmodel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('size_type') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="edit_size_list" value="true">

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Size</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label for="size_type" class="form-label">Size</label>
                                    <input type="text" name="size_type" id="edit_size_type" placeholder="size"
                                        class="form-control" required>
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
                ajax: "{{ route('size_type') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '2%',
                        className: 'text-center'
                    },
                    {
                        data: 'size_name',
                        name: 'size_name',
                        width: '20%',
                        className: 'text-center'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '3%',
                        className: 'text-center'
                    }
                ]
            });

            $(document).on('click', '.editRow', function(e) {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('size_type') }}",
                    method: "GET",
                    dataType: "json",
                    data: {
                        id: id,
                        get_size: true,
                    },
                    success: function(data) {
                        $('#edit_id').val(data.id);
                        $('#edit_size_type').val(data.size_name);
                        $('#editmodel').modal("show");
                    }
                })
            });


            $(document).on('click', '.deleteRow', function() {

                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('size_type') }}",
                    type: "DELETE",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}",
                        delete_size: true,
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

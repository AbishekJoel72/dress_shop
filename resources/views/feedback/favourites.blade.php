@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">Favourites product List</h5>
                {{-- <div class="d-flex align-items-center gap-2 ms-auto">
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#Addmodel">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                </div> --}}
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone NO</th>
                            <th>Product Name</th>
                            <th>Category Name</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center'
                    },
                    {
                        data: 'get_user.first_name',
                        name: 'get_user.first_name',
                        width: '20%',
                    },
                    {
                        data: 'get_user.email',
                        name: 'get_user.email',
                        width: '20%',

                    },
                    {
                        data: 'get_user.phone_no',
                        name: 'get_user.phone_no',
                        width: '20%',

                    },
                        {
                        data: 'get_product.product_name',
                        name: 'get_product.product_name',
                        width: '20%',
                    },
                        {
                        data: 'get_product.get_category.name',
                        name: 'get_product.get_category.name',
                        width: '20%',
                    },

                ]
            });

        });
    </script>
@endsection

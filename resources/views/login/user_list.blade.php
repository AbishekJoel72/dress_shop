@extends('layouts.admin.default')
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">List Customer</h5>
                {{-- <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#Addmodel">
                    <i class="fa-solid fa-plus"></i> Add New
                </a> --}}
            </div>
            <div class="card-body">

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
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
                ajax: "{{ route('user_list_details') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center'
                    },
                    {
                        data: 'full_name',
                        name: 'full_name',
                        width: '30%',
                    },
                    {
                        data: 'email',
                        name: 'email',
                        width: '30%',

                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        width: '30%',

                    },

                ]
            });


        });
    </script>
@endsection

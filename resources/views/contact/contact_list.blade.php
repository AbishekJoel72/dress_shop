
@extends('layouts.admin.default')
@section('content')
    <div class="container">
              <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">List Contact</h5>
            </div>
            <div class="card-body">

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            {{-- <th>Name</th> --}}
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
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
@include("layouts.datatable")
 <script>
             $(document).ready(function() {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contact_list') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center'
                    },
                    {
                        data: 'email',
                        name: 'email',

                    },
                    {
                        data: 'phone',
                        name: 'phone',

                    },
                    {
                        data: 'message',
                        name: 'message',

                    },


                ]
            });


        });
    </script>
@endsection

@php
   @include('layouts.script')
@endphp
<header id="header" class="d-flex justify-content-between align-items-center ">
    <style>
        .datepicker {
            border-radius: 12px;
            padding: 10px;
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            font-family: 'Poppins', sans-serif;
        }

        .datepicker .datepicker-switch {
            font-weight: 600;
            color: #333;
        }

        .datepicker .prev,
        .datepicker .next {
            color: #e62a49;
            font-size: 18px;
        }

        .datepicker table tr td,
        .datepicker table tr th {
            text-align: center;
            border-radius: 8px;
            padding: 8px;
        }

        .datepicker table tr td:hover {
            background: #f1f1f1;
            cursor: pointer;
        }

        .datepicker table tr td.active,
        .datepicker table tr td.active:hover {
            background: #9b87f2;
            color: #fff;
            border-radius: 8px;
        }

        .datepicker table tr td.today {
            background: #ffe5ea;
            border-radius: 8px;
        }

        .datepicker table tr td.disabled {
            color: #ccc !important;
            cursor: not-allowed;
        }

        .datepicker .month,
        .datepicker .year {
            border-radius: 8px;
            padding: 6px;
        }

        .datepicker .month:hover,
        .datepicker .year:hover {
            background: #f1f1f1;
        }

        .datepicker .month.active,
        .datepicker .year.active {
            background: #9b87f2;
            color: #fff;
        }
    </style>
    @php
        use App\Models\Configuration;
        $config = Configuration::first();
        use App\Models\CartList;
        $cartCount = CartList::where('user_id', session('user_id'))->count();
    @endphp
    @if (!empty($config->logo))
        <img src="{{ asset($config->logo) }}" width="190" height="100" alt="Company Logo" class="img-thumbnail">
    @else
        <p class="mb-0">Image Not Define</p>
    @endif


    {{-- Search Bar --}}
    <div class="flex-grow-1 px-3 search">
        <input type="search" name="search_items" id="search_items" placeholder="Search..." class="form-control w-50">
    </div>

    <style>

    </style>
    {{-- Navigation Menu --}}
    <ul class="nav me-3 ">
        <li class="nav-item">
            <a href="{{ route('cart') }}" class="nav-link text-light">
                <i class="fa-solid fa-shopping-cart"></i> Cart
                <sup class="badge bg-danger rounded-circle">{{ $cartCount }}</sup>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('order_placed') }}" class="nav-link text-light">
                <i class="fa-solid fa-box"></i> Order
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-light">
                <i class="fa-solid fa-rotate-left"></i> Return
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('feedback') }}" class="nav-link text-light">
                <i class="fa-solid fa-comment-dots"></i> Feedback
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ route('contact') }}" class="nav-link text-light ">
                <i class="fa-solid fa-envelope"></i> Contact
            </a>
        </li> --}}
    </ul>

    {{-- Admin Dropdown --}}
    <nav class="bg-light p-3" style="color: #9b87f2; border-radius:5px;">

        @php
            use App\Models\Registration;
            $user = session('user_id');
            $register = Registration::where('id', $user)->first();
        @endphp
        <div class="dropdown">
            <div class=" d-flex flex-column align-items-start" id="adminDropdown" data-bs-toggle="dropdown"
                aria-expanded="false" style="cursor:pointer;">
                @if ($register)
                    <span><i class="fa fa-user"></i> {{ $register->first_name }} {{ $register->last_name }} </span>
                    <span><i class="fa fa-envelope"></i> {{ $register->email }}</span>
                @else
                    <span><i class="fa fa-user"></i> Guest</span>
                @endif


            </div>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                <li>
                    <a href="#" class="dropdown-item editProfileBtn" data-id="{{ session('user_id') }}"
                        data-bs-toggle="offcanvas" data-bs-target="#editCanvas">
                        Edit Profile
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item text-danger">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>



    <div class="offcanvas offcanvas-end" tabindex="-1" id="editCanvas">
        <form id="profileUpdateForm">
            @csrf
            <div class="offcanvas-header">
                <h5>Edit User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <input type="hidden" name="id" id="user_id">
                <div class="row">
                    <div class="col-12">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" id="first_name" placeholder="First Name" required
                            class="form-control">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name"
                            class="form-control">
                    </div>
                    <div class="col-12  mt-3">
                        <label for="gender">Gender <span class="text-danger">*</span> </label>
                        <div class=" d-flex align-items-center gap-3">
                            <div class="form-check">
                                <input type="radio" name="gender" id="gender_m" value="m"
                                    class="form-check-input" required>
                                <label for="gender_m" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="gender_f" value="f"
                                    class="form-check-input" required>
                                <label for="gender_f" class="form-check-label">Female</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="gender_o" value="o"
                                    class="form-check-input" required>
                                <label for="gender_o" class="form-check-label">Other</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                        <input type="text" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth"
                            required class="form-control">

                    </div>
                    <div class="col-6">
                        <label for="age">Age</label>
                        <input type="text" name="age" id="age" placeholder="Age" required
                            class="form-control" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 ">
                        <label for="phone">Phone Number <span class="text-danger">*</span> </label>
                        <input type="tel" name="phone" id="phone" placeholder="Phone Number" required
                            class="form-control">
                    </div>
                    <div class="col-12  mt-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            class="form-control">
                    </div>
                </div>


            </div>
            <div class="offcanvas-footer text-center">
                <button type="submit" class="btn btn-primary">Update Profile Details</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#date_of_birth').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
                endDate: new Date(),
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2026"
            }).on('changeDate', function(e) {
                let dob = $(this).val();
                calculateAge(dob);
            });


            function calculateAge(dob) {
                let parts = dob.split("-");
                let day = parts[0];
                let month = parts[1] - 1;
                let year = parts[2];
                let birthDate = new Date(year, month, day);
                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                $('#age').val(age);
            }


        });

        $(document).on('click', '.editProfileBtn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '{{ route('update_user_profile') }}',
                type: 'GET',
                data: {
                    id: id,
                    get_user_details: true,
                },
                success: function(response) {
                    $('#user_id').val(response.id);
                    $('#first_name').val(response.first_name);
                    $('#last_name').val(response.last_name);
                    $('input[name="gender"][value="' + response.gender + '"]')
                        .prop('checked', true);
                    let dob = response.date_of_birth;
                    if (dob) {
                        let parts = dob.split('-');
                        let formattedDob = parts[2] + '-' + parts[1] + '-' + parts[0];
                        $('#date_of_birth').val(formattedDob);
                    }
                    $('#age').val(response.age);
                    $('#phone').val(response.phone_no);
                    $('#email').val(response.email);
                }
            });
        });

        $(document).on('submit', '#profileUpdateForm', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('update_user_profile') }}',
                type: 'POST',
                data: $(this).serialize() + '&edit_profile=true',
                success: function(response) {
                    if (response.status) {
                        $('#modalMessage').text(response.message);
                        $('#sessionModal .modal-content')
                            .removeClass('border-danger')
                            .addClass('border-success');
                        let modal = new bootstrap.Modal(
                            document.getElementById('sessionModal')
                        );
                        modal.show();
                        var offcanvas = bootstrap.Offcanvas.getInstance(
                            document.getElementById('editCanvas')
                        );
                        if (offcanvas) {
                            offcanvas.hide();
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
</header>

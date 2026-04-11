@extends('layouts.admin.default')
@section('content')
    <style>
        .col-6,
        .col-4,
        .col-3,
        .col-5 {
            min-height: 90px;
        }

        .text-danger {
            font-size: 13px;
        }
    </style>
    <div class="container">

        <form action="{{ route('configuration') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <input type="hidden" name="config" value="true">
            <input type="hidden" name="id" value="{{ $config->id ?? null }}">
            <div class="card m-3 r-0 ">
                <div class="card-header bg-transparent">
                    <h5> Company Configuration Details</h5>
                </div>
                <div class="card-body m-4">
                    <div class="row ">
                        <div class="col-6 form-field">
                            <label for="company_name"><strong>Company Name <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" name="company_name" id="company_name" class="form-control" required
                                placeholder="Company Name" value="{{ $config->company_name ?? null }}">
                            <small class="text-danger"></small>
                        </div>
                        <div class="col-6 form-field">
                            <label for="tag_line"><strong>Tag Line <span class="text-danger">*</span></strong></label>
                            <input type="text" name="tag_line" id="tag_line" required placeholder="Tag Line"
                                class="form-control" value="{{ $config->tag_line ?? null }}">
                            <small class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row  mt-4">
                        <div class="col-6 form-field">
                            <label for="phone"><strong>Phone NO <span class="text-danger">*</span></strong></label>
                            <input type="text" name="phone" id="phone" class="form-control" required
                                placeholder="Phone NO" value="{{ $config->phone ?? null }}">
                            <small class="text-danger"></small>
                        </div>
                        <div class="col-6 form-field">
                            <label for="alter_phone"><strong>Alter No <span class="text-danger">*</span></strong></label>
                            <input type="text" name="alter_phone" id="alter_phone" placeholder="Alter No"
                                class="form-control" value="{{ $config->alter_phone ?? null }}">
                            <small class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6 form-field">
                            <label for="email"><strong>Email-ID <span class="text-danger">*</span></strong></label>
                            <input type="email" name="email" id="email" class="form-control" required
                                placeholder="Email-ID" value="{{ $config->email ?? null }}">
                            <small class="text-danger"></small>

                        </div>
                        <div class="col-6 form-field">
                            <label for="support_email"><strong>Support Email-ID <span
                                        class="text-danger">*</span></strong></label>
                            <input type="email" name="support_email" id="support_email" placeholder="Support Email-ID"
                                class="form-control" value="{{ $config->support_email ?? null }}">
                            <small class="text-danger"></small>

                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 form-field">
                            <label for="address"><strong>Address <span class="text-danger">*</span></strong></label>
                            <textarea name="address" id="address" rows="5" placeholder="Address" class="form-control" required>{{ $config->address ?? null }}</textarea>
                            <small class="text-danger"></small>
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-4 form-field">
                            <label for="state_id"><strong>State <span class="text-danger">*</span></strong></label>
                            <select name="state_id" id="state_id" class="form-select select2" required>
                                <option value="" selected disabled>Select State</option>
                                @foreach ($state as $s)
                                    <option value="{{ $s->id }}"
                                        {{ old('state_id', $config->state_id ?? '') == $s->id ? 'selected' : '' }}>
                                        {{ $s->state_name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger"></small>
                        </div>
                        <div class="col-4 form-field">
                            <label for="city_id"><strong>City <span class="text-danger">*</span></strong></label>
                            <select name="city_id" id="city_id" class="form-select select2" required>
                                <option value="" selected disabled>Select City</option>
                                @foreach ($city as $c)
                                    <option value="{{ $c->id }}"
                                        {{ old('city_id', $config->city_id ?? '') == $c->id ? 'selected' : '' }}>
                                        {{ $c->city_name }}</option>
                                @endforeach
                                <small class="text-danger"></small>
                            </select>
                        </div>
                        <div class="col-4 form-field">
                            <label for="pincode"><strong>Pincode <span class="text-danger">*</span></strong> </label>
                            <input type="number" name="pincode" id="pincode" placeholder="Pincode"
                                class="form-control" value="{{ $config->pincode ?? null }}" required>
                            <small class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row  mt-4">
                        <div class="col-6 form-field">
                            <label for="website_url"><strong>Website URL <span class="text-danger">*</span></strong>
                            </label>
                            <input type="url" name="website_url" id="website_url" class="form-control" required
                                placeholder="Website URL" value="{{ $config->website_url ?? null }}">
                            <small class="text-danger"></small>
                        </div>

                        <div class="col-6 form-field">
                            <label for="facebook"><strong>Facebook <span class="text-danger">*</span></strong></label>
                            <input type="text" name="facebook" id="facebook" class="form-control" required
                                placeholder="facebook" value="{{ $config->facebook ?? null }}">
                            <small class="text-danger"></small>


                        </div>



                    </div>

                    <div class="row  mt-4">
                        <div class="col-6 form-field">
                            <label for="instagram"><strong>Instagram <span class="text-danger">*</span></strong></label>
                            <input type="text" name="instagram" id="instagram" class="form-control" required
                                placeholder="Instagram" value="{{ $config->instagram ?? null }}">
                            <small class="text-danger"></small>

                        </div>

                        <div class="col-6 form-field">
                            <label for="twitter"><strong>Twitter <span class="text-danger">*</span></strong></label>
                            <input type="text" name="twitter" id="twitter" class="form-control" required
                                placeholder="Twitter" value="{{ $config->twitter ?? null }}">
                            <small class="text-danger"></small>

                        </div>

                    </div>
                    <div class="row  mt-4">
                        <div class="col-5">
                            <label for="logo"><strong>Logo</strong></label>
                            <input type="file" name="logo" id="logo" accept="image/*" class="form-control">
                            <small id="logoError" style="color:red;"></small>

                            @if (!empty($config->logo))
                                <div class="mt-1">
                                    <img src="{{ asset($config->logo) }}"
                                        style="width: 150px; height:auto; border:1px solid #000; border-radius:0px; padding:2px;"
                                        alt="Company Logo" class="img-thumbnail">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk">
                        </i> Submit</button>
                    <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i>
                        Reset</button>
                </div>
            </div>
        </form>

        @include('layouts.footer')
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
            });
        });



        const logoInput = document.getElementById('logo');
        const logoError = document.getElementById('logoError');

        logoInput.addEventListener('change', function() {
            logoError.textContent = '';
            const file = this.files[0];
            if (file) {
                const img = new Image();
                img.src = URL.createObjectURL(file);
                img.onload = function() {
                    if (img.width !== 250 || img.height !== 100) {
                        logoError.textContent = 'Image must be exactly 250x100 pixels!';
                        logoInput.value = '';
                    }
                }
            }
        });
    </script>


    <script>
        $('#state_id').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: '{{ route('configuration') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        stateID: stateID,
                        get_city: true,
                    },
                    success: function(data) {
                        $('#city_id').empty();
                        $('#city_id').append('<option value="" selected disabled>Select City</option>');
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="' + value.id + '">' + value
                                .city_name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="" selected disabled>Select City</option>');
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function showError(input, message) {
                let error = input.parentElement.querySelector("small");
                error.innerText = message;
            }

            function clearError(input) {
                let error = input.parentElement.querySelector("small");
                error.innerText = "";
            }


            const company = document.getElementById("company_name");
            const tagline = document.getElementById("tag_line");
            const phone = document.getElementById("phone");
            const alterphone = document.getElementById("alter_phone");
            const email = document.getElementById("email");
            const supportemail = document.getElementById("support_email");
            const address = document.getElementById("address");
            const stateid = document.getElementById("state_id");
            const cityid = document.getElementById("city_id");
            const pincode = document.getElementById("pincode");
            const websiteurl = document.getElementById("website_url");
            const facebook = document.getElementById("facebook");
            const twitter = document.getElementById("twitter");
            const instagram = document.getElementById("instagram");

            company.addEventListener("input", function() {
                const value = this.value.trim();

                if (value === "") {
                    showError(this, "Field is required");
                } else if (!/^[A-Za-z\s]+$/.test(value)) {
                    showError(this, "Only letters allowed");
                } else {
                    clearError(this);
                }
            });


            tagline.addEventListener("input", function() {
                const value = this.value.trim();

                if (value === "") {
                    showError(this, "Field is required");
                } else if (!/^[A-Za-z\s]+$/.test(value)) {
                    showError(this, "Only letters allowed");
                } else {
                    clearError(this);
                }
            });

            phone.addEventListener("input", function() {
                const value = this.value;

                if (!/^\d{10}$/.test(value)) {
                    showError(this, "Enter valid 10 digit number");
                } else {
                    clearError(this);
                }
            });

            alterphone.addEventListener("input", function() {
                const value = this.value;

                if (!/^\d{10}$/.test(value)) {
                    showError(this, "Enter valid 10 digit number");
                } else {
                    clearError(this);
                }
            });

            email.addEventListener("input", function() {
                const value = this.value;

                if (!/^\S+@\S+\.\S+$/.test(value)) {
                    showError(this, "Enter valid email");
                } else {
                    clearError(this);
                }
            });

            supportemail.addEventListener("input", function() {
                const value = this.value;

                if (!/^\S+@\S+\.\S+$/.test(value)) {
                    showError(this, "Enter valid email");
                } else {
                    clearError(this);
                }
            });

            address.addEventListener("input", function() {
                const value = this.value.trim();

                if (value === "") {
                    showError(this, "Field is required");
                } else {
                    clearError(this);
                }
            });

            stateid.addEventListener("input", function() {
                const value = this.value.trim();

                if (value === "") {
                    showError(this, "Field is required");
                } else {
                    clearError(this);
                }
            });

            cityid.addEventListener("input", function() {
                const value = this.value.trim();

                if (value === "") {
                    showError(this, "Field is required");
                } else {
                    clearError(this);
                }
            });


            pincode.addEventListener("input", function() {
                const value = this.value;

                if (!/^\d{6}$/.test(value)) {
                    showError(this, "Pincode must be 6 digits");
                } else {
                    clearError(this);
                }
            });

            websiteurl.addEventListener("input", function() {
                const value = this.value.trim();

                if (value === "") {
                    showError(this, "Field is required");
                    return;
                } else {
                    clearError(this);
                }
            });

            facebook.addEventListener("input", function() {
                const value = this.value;

                if (value === "") {
                    showError(this, "Field is required");
                    return;
                } else {
                    clearError(this);
                }

            });

            instagram.addEventListener("input", function() {
                const value = this.value;

                if (value === "") {
                    showError(this, "Field is required");
                    return;
                } else {
                    clearError(this);
                }
            });

            twitter.addEventListener("input", function() {
                const value = this.value;

                if (value === "") {
                    showError(this, "Field is required");
                    return;
                } else {
                    clearError(this);
                }
            });




        });
    </script>
@endsection

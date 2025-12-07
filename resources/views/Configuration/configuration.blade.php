@extends('layouts.admin.default')
@section('content')
    <div class="container">

        <form action="{{ route('configuration') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <input type="hidden" name="config" value="true">
            <input type="hidden" name="id" value="{{ $config->id }}">
            <div class="card m-3 r-0 ">
                <div class="card-header bg-transparent">
                    <h5> Company Configuration Details</h5>
                </div>
                <div class="card-body m-4">
                    <div class="row ">
                        <div class="col-6">
                            <label for="company_name"><strong>Company Name</strong></label>
                            <input type="text" name="company_name" id="company_name" class="form-control" required
                                placeholder="Company Name" value="{{ $config->company_name ?? null}}">
                        </div>
                        <div class="col-6">
                            <label for="tag_line"><strong>Tag Line</strong></label>
                            <input type="text" name="tag_line" id="tag_line" required placeholder="Tag Line"
                                class="form-control" value="{{ $config->tag_line ?? null}}">
                        </div>
                    </div>

                    <div class="row  mt-4">
                        <div class="col-6">
                            <label for="phone"><strong>Phone NO</strong></label>
                            <input type="number" name="phone" id="phone" class="form-control" required
                                placeholder="Phone NO" value="{{ $config->phone ?? null}}">
                        </div>
                        <div class="col-6">
                            <label for="alter_phone"><strong>Alter No</strong></label>
                            <input type="number" name="alter_phone" id="alter_phone" placeholder="Alter No"
                                class="form-control" value="{{ $config->alter_phone ?? null}}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <label for="email"><strong>Email-ID</strong></label>
                            <input type="email" name="email" id="email" class="form-control" required
                                placeholder="Email-ID" value="{{ $config->email ?? null}}">
                        </div>
                        <div class="col-6">
                            <label for="support_email"><strong>Support Email-ID</strong></label>
                            <input type="email" name="support_email" id="support_email" placeholder="Support Email-ID"
                                class="form-control" value="{{ $config->support_email ?? null}}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <label for="address"><strong>Address</strong></label>
                            <textarea name="address" id="address" rows="5" placeholder="Address" class="form-control" required>{{ $config->address ?? null}}</textarea>
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-4">
                            <label for="email"><strong>State</strong></label>
                            <select name="state_id" id="state_id" class="form-select" required>
                                <option value="" selected disabled>Select State</option>
                                @foreach ($state as $s)
                                    <option value="{{ $s->id }}"
                                        {{ old('state_id', $config->state_id ?? '') == $s->id ? 'selected':'' }}>{{ $s->state_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-4">
                            <label for="city_id"><strong>City</strong></label>
                            <select name="city_id" id="city_id" class="form-select" required>
                                <option value="" selected disabled>Select City</option>
                                @foreach ($city as $c)
                                    <option value="{{ $c->id }}"
                                        {{ old('city_id', $config->city_id ?? '') == $c->id ? 'selected':'' }}>{{ $c->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="pincode"><strong>Pincode</strong></label>
                            <input type="number" name="pincode" id="pincode" placeholder="Pincode" class="form-control"
                            value="{{ $config->pincode   ?? null}}" required>
                        </div>
                    </div>

                    <div class="row  mt-4">
                        <div class="col-3">
                            <label for="website_url"><strong>Website URL</strong></label>
                            <input type="url" name="website_url" id="website_url" class="form-control" required
                                placeholder="Website URL" value="{{ $config->website_url ?? null}}">
                        </div>

                        <div class="col-3">
                            <label for="facebook"><strong>Facebook</strong></label>
                            <input type="text" name="facebook" id="facebook" class="form-control" required
                                placeholder="facebook" value="{{ $config->facebook ?? null}}">
                        </div>

                        <div class="col-3">
                            <label for="instagram"><strong>Instagram</strong></label>
                            <input type="text" name="instagram" id="instagram" class="form-control" required
                                placeholder="Instagram" value="{{ $config->instagram ?? null}}">
                        </div>

                        <div class="col-3">
                            <label for="twitter"><strong>Twitter</strong></label>
                            <input type="text" name="twitter" id="twitter" class="form-control" required
                                placeholder="Twitter" value="{{ $config->twitter ?? null}}">
                        </div>

                    </div>
                    <div class="row  mt-4">
                        <div class="col-5">
                            <label for="logo"><strong>Logo</strong></label>
                            <input type="file" name="logo" id="logo" accept="image/*" class="form-control" >
                            <small id="logoError" style="color:red;"></small>

                            @if(!empty($config->logo))
                                <div class="mt-1">
                                    <img src="{{ asset($config->logo) }}"
                                    style="width: 150px; height:auto; border:1px solid #000; border-radius:0px; padding:2px;" alt="Company Logo" class="img-thumbnail" >
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk">
                        </i> Submit</button>
                    <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                </div>
            </div>
        </form>

        @include('layouts.footer')
    </div>
@endsection
@section('script')
    <script>
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
                    data:{
                        stateID:stateID,
                        get_city:true,
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
@endsection

@extends('layouts.user.default')

@section('content')
    <div class="container-fluid ">
        <style>
            .border-divider {
                border-right: 1px solid #ddd;
                padding-right: 25px;
            }
        </style>

        <div class="row justify-content-center">
            <div class="col-lg-10">


                <div class="card shadow-sm p-4">
                    <div class="row align-items-start">

                        <!-- LEFT : COMPANY DETAILS -->
                        <div class="col-md-5 mb-4 mb-md-0 border-divider">
                            @php
                                use App\Models\Configuration;
                                $config = Configuration::first();
                            @endphp
                            <h3 class="fw-bold text-center text-md-start">Get in Touch</h3>

                            <p class="text-muted mt-3">
                                We’d love to hear from you! Reach out for any queries,
                                orders, or support regarding Trendora.
                            </p>
                            @if (!empty($config))
                                <ul class="list-unstyled mt-4">
                                    <li class="mb-3">
                                        <strong>Company:</strong><br>
                                        {{ $config->company_name }} - {{ $config->tag_line }}

                                    </li>
                                    <li class="mb-3">
                                        <strong>Address:</strong><br>
                                        {{ $config->address }}
                                    </li>
                                    <li class="mb-3">
                                        <strong>Email:</strong><br>
                                        {{ $config->email }}
                                    </li>
                                    <li>
                                        <strong>Phone:</strong><br>
                                        {{ $config->phone }}
                                    </li>
                                </ul>
                            @endif

                        </div>


                        <!-- RIGHT : CONTACT FORM -->
                        <div class="col-md-7">
                            <h4 class="fw-bold mb-4 text-center text-md-start">
                                Send Us a Message
                            </h4>

                            @php
                                use App\Models\Registration;
                                $user = session('user_id');
                                $register = Registration::where('id',$user)->first();
                            @endphp
                            <form action="" method="POST" autocomplete="off">
                                @csrf
                                <input type="hidden" name="contacts" value="true">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{ $register->email ?? ''}}" name="email" placeholder="Enter your email">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $register->phone?? '' }}" placeholder="Enter your phone number">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" name="message"  placeholder="Type your message"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary px-4">
                                    Submit
                                </button>
                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </div>

    @include('layouts.user.footer')
@endsection

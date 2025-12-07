<html>
@include('layouts.head')
<style>
    body {
        background-color: #0092ca;
        font-family: Arial, sans-serif;
    }

    .container {
        margin-top: 30px;
        max-width: 50%;
        background: #fff;
        padding: 40px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }

    label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
        width: 100%;
        margin-bottom: 20px;
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        cursor: pointer;
        background: linear-gradient(90deg, #0092ca, #ec107a);
    }

    .forgot {
        columns: #0092ca;
        text-decoration: none;
    }
</style>

<body>

    <div class="container">
        <form action="{{ route('registration') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="add_registration" value="true">
            <h3>Registration</h3>
            <div class="row mt-5">

                <div class="col">
                    <label for="first_name">First Name</label>
                    <input type="first_name" name="first_name" id="first_name" placeholder="First Name" required
                        class="form-control">
                </div>

                <div class="col">
                    <label for="last_name">Last Name</label>
                    <input type="last_name" name="last_name" id="last_name" placeholder="Last Name"
                        class="form-control">
                </div>


            </div>

            <div class="row">
                <div class="col">

                    <label for="gender">Gender</label>
                    <div class=" d-flex align-items-center gap-3">
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender_m" value="m" class="form-check-input"
                                required>
                            <label for="gender_m" class="form-check-label">Male</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="gender" id="gender_f" value="f" class="form-check-input"
                                required>
                            <label for="gender_f" class="form-check-label">Female</label>
                        </div>

                    </div>
                </div>



                <div class="col">
                    <label for="phone">Phone Number</label>
                    <input type="phone" name="phone" id="phone" placeholder="Phone Number" required
                        class="form-control">
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required
                        class="form-control">
                </div>
                <div class="col">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" required
                        class="form-control">
                </div>


            </div>
            <div class="row">
                <div class="col">
                    <label for="confirmation_password">Confirmation Password</label>
                    <input type="password" name="confirmation_password" id="confirmation_password"
                        placeholder="Confirmation Password" required class="form-control">
                </div>
            </div>

            <div class="col-12 mt-4">
                <button type="submit">Registration</button>
            </div>

            <p class="mt-3">You have an Account? <a href="{{ route('login') }}"
                    style="text-decoration: none ; color:#0092ca"> Log In </a></p>


        </form>
    </div>
</body>

</html>

<!DOCTYPE html>
<html>
@include('layouts.head')
<style>
    body {
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%);
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        margin: 6px auto;
        max-width: 1000px;
        width: 100%;
        background: #fff;
        padding: 10px 40px;
        border-radius: 0px;
    }
    h3 {
        font-weight: 600;
        text-align: center;
        margin-bottom: 30px;
    }
    .row {
        display: flex;
        gap: 25px;
        margin-bottom: 25px;
    }
    .col {
        flex: 1;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    label {
        font-weight: 500;
        font-size: 14px;
        display: block;
        color: #333;
        padding-left: 2px;
    }
    .form-control,
    .form-select {
        border: none;
        border-bottom: 2px solid #ccc;
        border-radius: 0;
        padding: 10px 5px;
        width: 100%;
        margin-bottom: 20px;
        background: transparent;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-bottom: 2px solid #e62a49;
        box-shadow: none;
        outline: none;
    }
    .form-control:hover {
        border-bottom: 2px solid #e62a49;
    }
    .form-check-input:checked {
        background-color: #e62a49;
        border-color: #e62a49;
    }
    .form-control:focus+label {
        color: #e62a49;
    }
    ::placeholder {
        font-size: 13px;
        color: #aaa;
    }
    button {
        width: 100%;
        padding: 12px;
        border: none;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        cursor: pointer;
        background: linear-gradient(145deg, #e62a49, #b11e36);
    }
    .login {
        text-decoration: none;
        color: #0092ca
    }
    .login:hover {
        text-decoration: none;
        color: #e62a49
    }
    .error {
        color: red;
        font-size: 12px;
        height: 14px;
        margin-top: 2px;
        line-height: 14px;
    }
    .input-error {
        border-bottom: 2px solid red !important;
    }
    .input-icon {
        position: absolute;
        right: 10px;
        top: 38px;
        color: #999;
        font-size: 16px;
        cursor: pointer;
    }
    .input-icon:hover {
        color: #e62a49;
    }
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

    @media(max-width:768px) {
        .row {
            display: block;
        }
        .col {
            width: 100%;
        }
        .container {
            padding: 18px;
        }
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
                    <label for="first_name">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" required
                        class="form-control">
                    <small class="error" id="error_first_name"></small>
                </div>
                <div class="col">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
                    <small class="error" id="error_last_name"></small>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="gender">Gender <span class="text-danger">*</span> </label>
                    <div class=" d-flex align-items-center gap-3">
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender_m" value="m" class="form-check-input"
                                required checked>
                            <label for="gender_m" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender_f" value="f" class="form-check-input"
                                required>
                            <label for="gender_f" class="form-check-label">Female</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender_o" value="o" class="form-check-input"
                                required>
                            <label for="gender_o" class="form-check-label">Other</label>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                    <input type="text" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" required
                        class="form-control">
                    <small class="error" id="error_date"></small>
                </div>
                <div class="col">
                    <label for="age">Age</label>
                    <input type="text" name="age" id="age" placeholder="Age" required class="form-control"
                        readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="phone">Phone Number <span class="text-danger">*</span> </label>
                    <input type="tel" name="phone" id="phone" placeholder="Phone Number" required
                        class="form-control">
                    <small class="error" id="error_phone"></small>
                </div>
                <div class="col">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" placeholder="Email" required
                        class="form-control">
                    <small class="error" id="error_email"></small>
                </div>
            </div>
            <div class="row">
                <div class="col position-relative">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" placeholder="Password" required
                        class="form-control pe-5">
                    <i class="fa fa-eye-slash input-icon" id="togglePassword"></i>
                    <small class="error" id="error_password"></small>
                </div>
                <div class="col position-relative">
                    <label for="confirmation_password">Confirmation Password <span
                            class="text-danger">*</span></label>
                    <input type="password" name="confirmation_password" id="confirmation_password"
                        placeholder="Confirmation Password" required class="form-control pe-5">
                    <i class="fa fa-eye-slash input-icon" id="togglePassword"></i>
                    <small class="error" id="error_confirmation_password"></small>
                </div>
            </div>
            <div class="col-12 mt-4">
                <button type="submit">Create Account</button>
            </div>
            <p class="mt-3 text-center">Already have an Account? <a href="{{ route('login') }}" class="login"> Sign In </a></p>
        </form>
    </div>
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

            function isValidName(name) {
                return /^[A-Za-z ]+$/.test(name);
            }

            function setError(id, message) {
                let errorEl = document.getElementById("error_" + id);
                if (errorEl) errorEl.innerText = message;
                document.getElementById(id).classList.add("input-error");
            }

            function clearError(id) {
                let errorEl = document.getElementById("error_" + id);
                if (errorEl) errorEl.innerText = "";
                document.getElementById(id).classList.remove("input-error");
            }

            document.querySelectorAll("input, select").forEach(input => {
                input.addEventListener("input", validateField);
                input.addEventListener("change", validateField);
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

            function validateField() {
                let id = this.id;
                let value = this.value.trim();
                clearError(id);
                if (id === "first_name") {
                    if (value.trim() === "") {
                        setError(id, "First name is required");
                    } else if (!isValidName(value)) {
                        setError(id, "Only letters allowed");
                    }
                }
                if (id === "last_name") {
                    if (value !== "" && !isValidName(value)) {
                        setError(id, "Only letters allowed");
                    }
                }
                if (id === "date_of_birth") {
                    if (value === "") {
                        setError(id, "Select DOB");
                    } else {
                        calculateAge(value); 
                    }
                }
                if (id === "age") {
                    if (value === "" || !/^\d+$/.test(value) || value <= 0 || value > 120) {
                        setError(id, "Enter valid age");
                    }
                }
                if (id === "phone") {
                    if (!/^\d{10}$/.test(value)) {
                        setError(id, "Enter valid 10 digit number");
                    }
                }
                if (id === "email") {
                    if (!/^\S+@\S+\.\S+$/.test(value)) {
                        setError(id, "Invalid email");
                    }
                }
                if (id === "password") {
                    if (value.length < 6) {
                        setError(id, "Minimum 6 characters");
                    }
                }
                if (id === "confirmation_password") {
                    let pwd = document.getElementById("password").value;
                    if (value !== pwd) {
                        setError(id, "Passwords do not match");
                    }
                }
            }

            document.querySelector("form").addEventListener("submit", function(e) {
                let valid = true;
                let fields = ["first_name", "last_name", "date_of_birth", "age", "phone", "email", "password", "confirmation_password"];
                fields.forEach(id => {
                    let el = document.getElementById(id);
                    if (el) {
                        el.dispatchEvent(new Event("input"));
                        if (el.classList.contains("input-error")) {
                            valid = false;
                        }
                    }
                });
                let gender = document.querySelector('input[name="gender"]:checked');
                if (!gender) {
                    alert("Select gender");
                    valid = false;
                }
                if (!valid) {
                    e.preventDefault();
                }
            });

            document.getElementById("togglePassword").addEventListener("click", function() {
                let pwd = document.getElementById("password");
                if (pwd.type === "password") {
                    pwd.type = "text";
                    this.classList.remove("fa-eye-slash");
                    this.classList.add("fa-eye");
                } else {
                    pwd.type = "password";
                    this.classList.remove("fa-eye");
                    this.classList.add("fa-eye-slash");
                }

            });
        });
    </script>
</body>
</html>

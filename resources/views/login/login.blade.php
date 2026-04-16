<!DOCTYPE html>
<html>
@include('layouts.head')
@include('layouts.script')

<style>
    body {
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%);
        font-family: 'Poppins'
            margin: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        width: 95%;
        max-width: 400px;
        background: #fff;
        padding: 40px;
        border-radius: 10px;
    }

    label {
        font-weight: 500;
        font-size: 14px;
        display: block;
        color: #333;
        padding-left: 2px;
    }

    .form-control {
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

    button:hover {
        opacity: 0.9;
    }

    .forgot {
        color: #0092ca;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
        margin-top: 5px;
        transition: color 0.3s ease;
    }

    .forgot:hover {
        color: #e62a49;
        text-decoration: underline;
    }

    .login {
        text-decoration: none;
        color: #0092ca
    }

    .login:hover {
        text-decoration: none;
        color: #e62a49
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

    @media (max-width: 480px) {
        .container {
            padding: 20px 15px;
        }

        h3 {
            font-size: 18px;
        }

        button {
            font-size: 14px;
        }
    }
</style>

<body>
    <div class="container">
        <form action="{{ route('login') }}" method="GET" autocomplete="off">
            @csrf
            <input type="hidden" name="login_method" value="true">
            <h3> Fashion Login</h3>
            <div class="row">
                <div class="col-12 mt-3 position-relative">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required
                        class="form-control pe-5">
                    <i class="fa fa-envelope input-icon"></i>
                </div>
                <div class="col-12 mt-2 position-relative">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" required
                        class="form-control pe-5">
                    <i class="fa fa-eye-slash input-icon" id="togglePassword"></i>
                </div>
                <a href="#" class="text-end forgot " id="forgot_password">Forgot Password</a>
                <div class="col-12 mt-4">
                    <button type="submit">Login</button>
                </div>
                <p class="mt-3 text-center">New to Fashion? <a href="{{ route('registration') }}" class="login">
                        Jointhe Style Club </a></p>
            </div>
        </form>
    </div>
</body>
<script>
    $(document).on("click", "#forgot_password", function(e) {
        e.preventDefault();
        var email = $("#email").val().trim();
        if (!email) {
            $("#modalMessage").text("Please enter your email address.");
            var modal = new bootstrap.Modal(document.getElementById('sessionModal'));
            modal.show();
            return false;
        }
        $.ajax({
            url: "{{ route('ajax_reset_password') }}",
            type: "GET",
            dataType: "json",
            data: {
                email: email,
                get_reset_pws: true,
            },
            success: function(data) {
                window.location.href = "reset_password?email=" + email;
            },
            error: function() {
                alert("Something went wrong. Please try again.");
            }
        });
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
</script>
</html>

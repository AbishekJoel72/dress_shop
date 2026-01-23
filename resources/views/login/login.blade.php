<!DOCTYPE html>
<html>
@include('layouts.head')
@include('layouts.script')

<style>
    body {
        background-color: #0092ca;
        font-family: 'Poppins', sans-serif;
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
            <h3>Login</h3>
            <div class="row">

                <div class="col-12 mt-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required
                        class="form-control">
                </div>

                <div class="col-12">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder=" Password" required
                        class="form-control">
                </div>


                <a href="#" class="text-end forgot " id="forgot_password">Forgot Password</a>

                <div class="col-12 mt-4">
                    <button type="submit">Login</button>
                </div>

                <p class="mt-3">Don't have an Account? <a href="{{ route('registration') }}"
                        style="text-decoration: none ; color:#0092ca"> Sign In </a></p>
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
</script>

</html>

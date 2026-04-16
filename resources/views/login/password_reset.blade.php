<!DOCTYPE html>
<html>
@include('layouts.head')
<style>
    body {
        background: linear-gradient(90deg, #e62a49 0%, #9b87f2 100%);
        font-family: 'Poppins';
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow-x: hidden;
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

    @media(max-width:768px) {
        .container {
            margin: 25px auto;
            padding: 20px 15px;
        }
        h3 {
            font-size: 20px;
            text-align: center;
        }
        button {
            font-size: 15px;
        }
    }
</style>
<body>
    <div class="container">
        <form action="{{ route('reset_password') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="reset" value="true">
            <h3>New Password</h3>
            <div class="row mt-5">
                <div class="col-12 position-relative">
                    <label for="password"> New Password</label>
                    <input type="password" name="password" id="password" placeholder=" New Password" required
                        class="form-control pe-5">
                        <i class="fa fa-eye-slash input-icon" id="togglePassword"></i>
                </div>
                <div class="col-12 position-relative">
                    <label for="confirmation_password">Confirmation Password</label>
                    <input type="password" name="confirmation_password" id="confirmation_password"
                        placeholder="Confirmation Password" required class="form-control pe-5">
                        <i class="fa fa-eye-slash input-icon" id="togglePassword"></i>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script>
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
</body>
</html>

<html>
@include('layouts.head')

<style>
    body {
        background-color: #0092ca;
        font-family: Arial, sans-serif;
    }

    .container {
        margin-top: 120px;
        max-width: 400px;
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
        <form action="{{ route('reset_password') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="reset" value="true">
            <h3>New Password</h3>

            <div class="row mt-5">

                <div class="col-12">
                    <label for="password"> New Password</label>
                    <input type="password" name="password" id="password" placeholder=" New Password" required
                        class="form-control">
                </div>

                <div class="col-12">
                    <label for="confirmation_password">Confirmation Password</label>
                    <input type="password" name="confirmation_password" id="confirmation_password"
                        placeholder="Confirmation Password" required class="form-control">
                </div>

                <div class="col-12 mt-4">
                    <button type="submit">Submit</button>
                </div>

            </div>
        </form>
    </div>
</body>

</html>

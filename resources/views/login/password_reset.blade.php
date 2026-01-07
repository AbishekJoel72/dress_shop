<!DOCTYPE html>
<html>
@include('layouts.head')

<style>
    body {
           background:#0092ca;
        font-family: 'Poppins', sans-serif;
        margin:0;
        padding:0;
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        overflow-x:hidden;
    }

    .container {
          max-width:420px;
        width:92%;
        background:#fff;
        padding:40px ;
        border-radius:10px;
        box-shadow:0 10px 25px rgba(0,0,0,0.25);
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

        @media(max-width:768px){
        .container{
            margin:25px auto;
            padding:20px 15px;
        }

        h3{
            font-size:20px;
            text-align:center;
        }

        button{
            font-size:15px;
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

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class RegistrationController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method("GET")) {
            if ($request->login_method) {
                $validation = $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);
                if ($validation) {
                    $user = Registration::where('email', $request->email)->first();
                    if ($user && Hash::check($request->password, $user->password)) {
                        $request->session()->put([
                            'user_id' => $user->id,
                            'user_role' => $user->role,
                            'user_email' => $user->email,
                            'user_phone' => $user->phone
                        ]);
                        if ($user->role === 'admin') {
                            session()->flash('success', 'Welcome Admin!');
                            return redirect()->route("dashboard");
                        } elseif ($user->role === 'user') {
                            session()->flash('success', 'Welcome!');
                            return redirect()->route("product_list");
                        } else {
                            session()->flash('error', 'Invalid Email and password!');
                            return redirect()->route("login");
                        }
                    } else {
                        session()->flash('error', 'Enter the field correctly');
                        return redirect()->back();
                    }
                }
            }
        }
        return view("login.login");
    }

    public function Registration(Request $request)
    {
        if ($request->method("POST")) {
            if ($request->add_registration) {
                try {
                    $validation  = $request->validate([
                        "first_name" => "required",
                        "phone" => "required",
                        "email" => "required",
                        "password" => "required",
                        "confirmation_password" => "required",

                    ]);
                    if ($validation) {
                        $reg = new Registration();
                        $reg->first_name = $request->first_name;
                        $reg->last_name = $request->last_name ?? null;
                        $reg->gender = $request->gender;
                        $reg->phone = $request->phone;
                        $reg->email = $request->email;
                        $reg->password = Hash::make($request->password);
                        $reg->confirmation_password = Hash::make($request->confirmation_password);
                        $reg->save();
                        session()->flash("success", "Register Successfully");
                        return redirect()->route("login");
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", "Register Failed, please try again");
                    return redirect()->back();
                }
            }
        }
        return view("login.registration");
    }

    public function AjaxResetPassword(Request $request)
    {
       if ($request->ajax()) {
             if ($request->get_reset_pws) {
                $email = $request->email;
                $user = Registration::where('email', $email)->first();
                return response()->json($user);
            }
       }
    }

    public function ResetPassword(Request $request)
    {

        $email = $request->email;
        $user = Registration::where('email', $email)->first();

        if (isset($user) && !empty($user)) {
            if ($request->method("POST")) {
                if ($request->reset) {
                    Registration::where('email', $email)->update([
                        'password' => Hash::make($request->password),
                        'confirmation_password' => Hash::make($request->confirmation_password),
                    ]);

                    return redirect()->route('login');
                }
            }
        }


        return view("login.password_reset", ['user' => $user]);
    }

    public function Logout(Request $request)
    {

        $request->session()->flush();
        session()->flash("success", "Logged Out Successfully!");
        return redirect()->route("home_page");
    }

    public function UserList(Request $request)
    {
        if ($request->ajax()) {
              $data = Registration::select(['id', 'first_name', 'last_name', 'email', 'phone'])
              ->where('role', 'user')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function($row){
                    return $row->lastname ? $row->first_name. ' '. $row->last_name: $row->first_name;
                })
                ->make(true);
        }
        return view('login.user_list');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class RegistrationController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method('GET')) {
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
                            'user_phone' => $user->phone,
                            'user_gender' => $user->gender,
                        ]);
                        if ($user->role === 'admin') {
                            session()->flash('success', 'Welcome Admin!');

                            return redirect()->route('dashboard');
                        } elseif ($user->role === 'user') {
                            session()->flash('success', 'Welcome!');

                            return redirect()->route('product_list');
                        } else {
                            session()->flash('error', 'Invalid Email and password!');

                            return redirect()->route('login');
                        }
                    } else {
                        session()->flash('error', 'Enter the field correctly');

                        return redirect()->back();
                    }
                }
            }
        }

        return view('login.login');
    }

    public function Registration(Request $request)
    {
        if ($request->method('POST')) {
            if ($request->add_registration) {
                try {
                    $validation = $request->validate([
                        'first_name' => 'required',
                        'date_of_birth' => 'required',
                        'phone' => 'required',
                        'email' => 'required',
                        'password' => 'required',
                        'confirmation_password' => 'required',
                    ]);
                    if ($validation) {
                        $reg = new Registration;
                        $reg->first_name = $request->first_name;
                        $reg->last_name = $request->last_name ?? null;
                        $reg->gender = $request->gender;
                        $reg->date_of_birth = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->format('Y-m-d');
                        $reg->age = $request->age;
                        $reg->phone_no = $request->phone;
                        $reg->email = $request->email;
                        $reg->password = Hash::make($request->password);
                        $reg->confirmation_password = Hash::make($request->confirmation_password);
                        $reg->save();
                        session()->flash('success', 'Register Successfully');

                        return redirect()->route('login');
                    }
                } catch (\Throwable $th) {
                    session()->flash('error', $th->getMessage());

                    return redirect()->back();
                }
            }
        }

        return view('login.registration');
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
        if (isset($user) && ! empty($user)) {
            if ($request->method('POST')) {
                if ($request->reset) {
                    Registration::where('email', $email)->update([
                        'password' => Hash::make($request->password),
                        'confirmation_password' => Hash::make($request->confirmation_password),
                    ]);

                    return redirect()->route('login');
                }
            }
        } else {
            session()->flash('error', 'Email not found!');
            return redirect()->back();
        }
        return view('login.password_reset', ['user' => $user]);
    }

    public function Logout(Request $request)
    {
        $request->session()->flush();
        session()->flash('success', 'Logged Out Successfully!');
        return redirect()->route('home_page');
    }

    public function UserList(Request $request)
    {
        if ($request->ajax()) {
            $data = Registration::select(['id','first_name','last_name','email','phone_no','created_at',])->where('role', 'user');

            if ($request->customer_name) {
                $data->where(function ($q) use ($request) {
                    $q->where('first_name', 'LIKE', '%'.$request->customer_name.'%')
                        ->orWhere('last_name', 'LIKE', '%'.$request->customer_name.'%');
                });
            }

            if ($request->email) {
                $data->where('email', 'LIKE', '%'.$request->email.'%');
            }

            if ($request->phone_no) {
                $data->where('phone_no', 'LIKE', '%'.$request->phone_no.'%');
            }

            if ($request->from_date) {
                $from = Carbon::createFromFormat('d-m-Y',$request->from_date)->format('Y-m-d');
                $data->whereDate('created_at', '>=', $from);
            }

            if ($request->to_date) {
                $to = Carbon::createFromFormat('d-m-Y',$request->to_date)->format('Y-m-d');
                $data->whereDate('created_at', '<=', $to);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($row) {
                    return $row->last_name
                        ? $row->first_name.' '.$row->last_name
                        : $row->first_name;
                })

                ->addColumn('registered_date', function ($row) {
                    return $row->created_at;
                })
                ->make(true);
        }
        return view('login.user_list');
    }


    public function UserProfileDetails(Request $request)
    {

        if ($request->ajax()) {
            if ($request->get_user_details) {
                $id = $request->id;
                $user = Registration::where('id', $id)->first();

                return response()->json($user);
            }

            if ($request->edit_profile) {

                Registration::where('id', $request->id)->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
                    'age' => $request->age,
                    'phone_no' => $request->phone,
                    'email' => $request->email,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Profile Updated Successfully',
                ]);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {

        if ($request->method("POST")) {
            if ($request->contact_ss) {
                try {
                    $validation = validator([
                        'email'   => 'required|email',
                        'phone'   => 'required',
                        'message' => 'required',
                    ]);
                    if ($validation) {
                        $c = new Contact();
                        $c->email = $request->email;
                        $c->phone = $request->phone;
                        $c->message = $request->message;
                        $c->save();
                        session()->flash("success", "Conteact Added Successfully");
                        return redirect()->route("home_page");
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", $th->getMessage());
                    return redirect()->back();
                }
            }
        }

        return view("home.home_page");
    }
}

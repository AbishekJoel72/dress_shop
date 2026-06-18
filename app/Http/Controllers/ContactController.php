<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    public function Contact(Request $request)
    {
        $user = session('user_id');
        if ($request->method('POST')) {
            if ($request->contacts) {
                try {
                    $validation = validator([
                        'email' => 'required|email',
                        'phone' => 'required',
                        'message' => 'required',
                    ]);
                    if ($validation) {
                        $c = new Contact;
                        $c->user_id = $user;
                        $c->email = $request->email;
                        $c->phone = $request->phone;
                        $c->message = $request->message;
                        $c->save();
                        session()->flash('success', 'Conteact Added Successfully');

                        return redirect()->route('contact');
                    }
                } catch (\Throwable $th) {
                    session()->flash('error', $th->getMessage());

                    return redirect()->back();
                }
            }
        }

        return view('contact.contact');
    }

    public function ContactList(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::query();
            if ($request->name) {
                $data->where('name', 'LIKE', '%'.$request->name.'%');
            }

            if ($request->email) {
                $data->where('email', 'LIKE', '%'.$request->email.'%');
            }

            if ($request->phone) {
                $data->where('phone', 'LIKE', '%'.$request->phone.'%');
            }

            if ($request->from_date) {
                $from = Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d');
                $data->whereDate('created_at', '>=', $from);
            }

            if ($request->to_date) {
                $to = Carbon::createFromFormat('d-m-Y',$request->to_date)->format('Y-m-d');
                $data->whereDate('created_at', '<=', $to);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('contact.contact_list');
    }
}

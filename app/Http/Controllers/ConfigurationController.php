<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Configuration;
use App\Models\State;
use Illuminate\Http\Request;


class ConfigurationController extends Controller
{
    public function Configuration(Request $request)
    {
        if ($request->method("POST")) {
            if ($request->config) {
                try {
                    $validation = $request->validate([
                        "company_name" => "required",
                        "tag_line" => "required",
                        "phone" => "required",
                        "email" => "required",
                        "address" => "required",
                        "state_id" => "required",
                        "city_id" => "required",
                        "pincode" => "required",
                        "website_url" => "required",
                        "facebook" => "required",
                        "instagram" => "required",
                        "twitter" => "required",

                    ]);

                    if ($validation) {
                        $data = [
                            'company_name' => $request->company_name,
                            'tag_line' => $request->tag_line,
                            'phone' => $request->phone,
                            'alter_phone' => $request->alter_phone,
                            'email' => $request->email,
                            'support_email' => $request->support_email,
                            'address' => $request->address,
                            'state_id' => $request->state_id,
                            'city_id' => $request->city_id,
                            'pincode' => $request->pincode,
                            'website_url' => $request->website_url,
                            'facebook' => $request->facebook,
                            'instagram' => $request->instagram,
                            'twitter' => $request->twitter,
                        ];
                        if ($request->hasFile('logo')) {
                            $file = $request->file('logo');
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $file->move(public_path('images'), $filename);
                            $data['logo'] = 'images/' . $filename;
                        }

                        if ($request->id) {
                            Configuration::where("id", $request->id)->update($data);
                            session()->flash("success", "Details Updated Successfully");
                        } else {
                            Configuration::create($data);
                            session()->flash("success", "Details Added Successfully");
                        }

                        return redirect()->route("configuration");
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", $th->getMessage());
                    return redirect()->back();
                }
            }
        }

        if ($request->get_city) {

            $state = $request->stateID;
            $city = City::where("state_id", $state)->get();
            return response()->json($city);
        }

        $data['state'] = State::all();
        $data['city'] = City::all();
        // $data['config'] = new Configuration();
        // if (!empty($data['config'] )) {
        //     # code...
            $data['config'] = Configuration::first();
        // }

        return view('Configuration.configuration')->with($data);
    }
}

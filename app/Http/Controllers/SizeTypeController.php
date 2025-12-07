<?php

namespace App\Http\Controllers;

use App\Models\Sizetype;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeTypeController extends Controller
{
    public function SizeType(Request $request)
    {

        if ($request->method("POST")) {
            if ($request->size_list) {
                try {
                    $validation = $request->validate([
                        'size_type' => "required"
                    ]);
                    if ($validation) {
                        $s = new Sizetype();
                        $s->size_name = $request->size_type;
                        $s->save();
                        session()->flash("success", "Size Added Successfully");
                        return redirect()->route("size_type");
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", $th->getMessage());
                    return redirect()->back();
                }
            }

            if ($request->edit_size_list) {
                try {
                    $validation = $request->validate([
                        'size_type' => "required"
                    ]);
                    if ($validation) {
                        Sizetype::where("id", $request->id)->update([
                            'size_name' => $request->size_type
                        ]);
                        session()->flash("success", "Size Updated Successfully");
                        return redirect()->route("size_type");
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", $th->getMessage());
                    return redirect()->back();
                }
            }
        }


        if ($request->ajax()) {
            if ($request->get_size) {
                $id = $request->id;
                $s = Sizetype::where('id', $id)->first();
                return response()->json($s);
            }

            if ($request->delete_size) {
                $id = $request->id;
                $s = Sizetype::where('id', $id)->delete();
                return response()->json($s);
            }
            $data = Sizetype::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                <div class="dropdown">
                    <a href="#" class="text-dark " role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" class="editRow dropdown-item" data-id="' . $row->id . '">Edit</a>
                        </li>
                        <li>
                            <a href="#" class="deleteRow dropdown-item text-danger" data-id="' . $row->id . '">Delete</a>
                        </li>
                    </ul>
                </div>
            ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view("size.size_type");
    }
}

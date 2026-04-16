<?php

namespace App\Http\Controllers;

use App\Exports\SizeTypeExport;
use App\Models\Sizetype;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Excel;
use Yajra\DataTables\Facades\DataTables;

use function Symfony\Component\String\s;

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
            if ($request->edit_status) {
                try {
                    $validation = $request->validate([
                        'status' => "required"
                    ]);
                    if ($validation) {
                        Sizetype::where('id', $request->id)->update([
                            'status' => $request->status,
                        ]);
                        session()->flash("success", "Status Updated Successfully");
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
            if ($request->get_status) {
                $id = $request->id;
                $s = Sizetype::where('id', $id)->first();
                return response()->json($s);
            }
            if ($request->delete_size) {
                $id = $request->id;
                $s = Sizetype::where('id', $id)->delete();
                return response()->json($s);
            }
            $query = Sizetype::select(['id', 'size_name', 'status']);
            if ($request->size_name) {
                $query->where('size_name', 'LIKE', '%' . $request->size_name . '%');
            }
            return DataTables::of($query)
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
                            <a href="#" class="editStatusRow dropdown-item" data-id="' . $row->id . '">Status</a>
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

    public function SizeTypeExport(Request $request)
    {
        $type = $request->type;
        if ($type == "excel") {
            return Excel::download(new SizeTypeExport, 'size_type.xlsx');
        }
        if ($type == "pdf") {
            $size_types = Sizetype::get();
            $pdf = Pdf::loadView('size.size_type_pdf', ['size_types' => $size_types]);
            return $pdf->download('size_types.pdf');
        }
    }
}

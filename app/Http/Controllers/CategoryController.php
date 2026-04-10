<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function Categories(Request $request)
    {
        if ($request->method("POST")) {
            if ($request->category) {
                try {
                    $validation = $request->validate([
                        'name' => "required"
                    ]);
                    if ($validation) {
                        $category = new Category();
                        $category->name = $request->name;
                        $category->description = $request->description;
                        $category->save();
                        session()->flash("success", "Category Added Successfully");
                        return redirect()->route("categories");
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", $th->getMessage());
                    return redirect()->back();
                }
            }

            if ($request->edit_category) {
                try {
                    $validation = $request->validate([
                        'name' => "required"
                    ]);
                    if ($validation) {
                        Category::where('id', $request->id)->update([
                            'name' => $request->name,
                            'description' => $request->description,
                        ]);
                        session()->flash("success", "Category Updated Successfully");
                        return redirect()->route("categories");
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
                        Category::where('id', $request->id)->update([
                            'status' => $request->status,
                        ]);
                        session()->flash("success", "Status Updated Successfully");
                        return redirect()->route("categories");
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", $th->getMessage());
                    return redirect()->back();
                }
            }
        }

        if ($request->ajax()) {

            if ($request->get_category) {
                $id = $request->id;
                $category = Category::where("id", $id)->first();
                return response()->json($category);
            }

            if ($request->get_status) {
                $id = $request->id;
                $category = Category::where("id", $id)->first();
                return response()->json($category);
            }

            if ($request->delete_cate) {
                $id = $request->id;
                $category = Category::where("id", $id)->delete();
                return response()->json($category);
            }

            $data = Category::select(['id', 'name', 'description', 'status'])->get();
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
                            <a href="javascript:void(0)"  class="editRow dropdown-item" data-id="' . $row->id . '">Edit</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"  class="editStatusRow dropdown-item" data-id="' . $row->id . '">Status</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="deleteRow dropdown-item text-danger" data-id="' . $row->id . '">Delete</a>
                        </li>
                    </ul>
                </div>
            ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view("category.category");
    }

    public function CategoryExport(Request $request)
    {
        $type = $request->type;

        if ($type == 'excel') {
            return Excel::download(new CategoryExport, 'categories.xlsx');
        }
        if ($type == 'pdf') {
            $categories = Category::get();
            $pdf = Pdf::loadView('category.category_pdf', ['categories' => $categories]);
            return $pdf->download('categories.pdf');
        }

        // return back()->with('error', 'Invalid export type');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function Product(Request $request)
    {

        if ($request->method("POST")) {
            if ($request->edit_status) {
                $id = $request->id;

                Product::where('id', $id)->update([
                    'status' => $request->status,
                ]);

                session()->flash('success', 'Status Updated Successfully');
                return redirect()->route('product');
            }
        }




        if ($request->ajax()) {

            if ($request->get_image) {
                $id = $request->id;
                $product = Product::where('id', $id)->first();
                return response()->json($product);
            }

            if ($request->get_status) {
                $id = $request->id;
                $product_status = Product::where('id', $id)->first();
                return response()->json($product_status);
            }

            if ($request->delete_product) {
                $id = $request->id;
                $pro = Product::with('get_category')->where('id', $id)->delete();
                // $pro->delete();
                return response()->json($pro);
            }


            $data = Product::with('get_category')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encryptedId = encrypt($row->id);
                    return '
                <div class="dropdown">
                    <a href="#" class="text-dark " role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="javascript:void(0)"  class="ViewimageRow dropdown-item" data-id="' . $row->id . '">View Image</a>
                        </li>

                        <li>
                            <a href="javascript:void(0)"  class="StatusRow dropdown-item" data-id="' . $row->id . '">Status</a>
                        </li>

                        <li>
                                 <a href="' . route("update_products", ["id" => $encryptedId, "get_product" => true]) . '"
                   class="editRow dropdown-item">Edit</a>
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
        return view('product.product');
    }

    public function UpdateProduct(Request $request)
    {

        if ($request->method("POST")) {
            if ($request->Product_update) {
                try {
                    $validation = $request->validate([
                        "product_name" => "required",
                        "price" => "required",
                        "category_id" => "required",
                        "stock" => "required",

                    ]);
                    if ($validation) {

                        if ($request->id) {
                            Product::where('id', $request->id)->update([
                                'product_name' => $request->product_name,
                                'description' => $request->description,
                                'price' => $request->price,
                                'discount_price' => $request->discount_price,
                                'category_id' => $request->category_id,
                                'stock' => $request->stock,

                            ]);
                            session()->flash("success", "Product Update Successfully");
                            return redirect()->route("product");
                        } else {
                            $p = new Product();
                            $p->product_name = $request->product_name;
                            $p->description = $request->description;
                            $p->price = $request->price;
                            $p->discount_price = $request->discount_price;
                            $p->category_id = $request->category_id;
                            $p->stock = $request->stock;


                            if ($request->hasFile('image_path')) {
                                $file = $request->file('image_path');
                                $filename = time() . '_' . $file->getClientOriginalName();
                                $file->move(public_path('images'), $filename);
                                $p->image_path = 'images/' . $filename;
                            }
                            $p->save();

                            session()->flash("success", "Product Added Successfully");
                            return redirect()->route("product");
                        }
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", $th->getMessage());
                    return redirect()->back();
                }
            }
        }


        if ($request->get_product) {
            $id = decrypt($request->id);
            $data['product'] = Product::with('get_category')->where('id', $id)->first();
        } else {
            $data['product'] = new Product;
        }
        $data['category'] = Category::get();
        return view('product.productlist')->with($data);
    }



    public function ProductList(Request $request)
    {

        $gender = session('user_gender');

        $categoryId = null;
        if ($gender === 'm') {
            $categoryId = Category::where('name', 'Men')->value('id');
        } elseif ($gender === 'f') {
            $categoryId = Category::where('name', 'Women')->value('id');
        }


        if ($request->ajax()) {
            $query = $request->get('q');
            $products = Product::query()
                ->when($query, function ($q) use ($query) {
                    $q->where('product_name', 'LIKE', "%{$query}%");
                })
                ->where('status', 1)
                ->get();

            return response()->json($products);
        }

        $data['products'] = Product::where('status', "1")->where('category_id', $categoryId)->get();
        return view('product.Product_list')->with($data);
    }
}

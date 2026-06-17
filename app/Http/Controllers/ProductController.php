<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Category;
use App\Models\Favourites;
use App\Models\Product;
use App\Models\ProductImages;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function Product(Request $request)
    {
        if ($request->method('POST')) {
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
                $product = Product::with('get_product_images')->where('id', $id)->first();

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

                return response()->json($pro);
            }

            $query = Product::with('get_category', 'get_product_images');
            if ($request->product_name) {
                $query->where('product_name', 'LIKE', '%'.$request->product_name.'%');
            }
            if ($request->category_id) {
                $query->where('category_id', $request->category_id);
            }
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            return DataTables::of($query)
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
                            <a href="javascript:void(0)"  class="ViewimageRow dropdown-item" data-id="'.$row->id.'">View Image</a>
                        </li>

                        <li>
                            <a href="javascript:void(0)"  class="StatusRow dropdown-item" data-id="'.$row->id.'">Status</a>
                        </li>

                        <li>
                                 <a href="'.route('update_products', ['id' => $encryptedId, 'get_product' => true]).'"
                   class="editRow dropdown-item">Edit</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="deleteRow dropdown-item text-danger" data-id="'.$row->id.'">Delete</a>
                        </li>
                    </ul>
                </div>
            ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['categories'] = Category::get();

        return view('product.product')->with($data);
    }

    public function UpdateProduct(Request $request)
    {
        if ($request->method('POST')) {
            if ($request->Product_update) {
                try {
                    $validation = $request->validate([
                        'product_name' => 'required',
                        'price' => 'required',
                        'category_id' => 'required',
                        'stock' => 'required',
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
                            if ($request->hasFile('image_path')) {
                                $oldImage = ProductImages::where('product_id', $request->id)->first();
                                if ($oldImage) {
                                    $oldPath = public_path($oldImage->image_path);
                                    if (file_exists($oldPath)) {
                                        unlink($oldPath);
                                    }
                                    $oldImage->delete();
                                }
                                $file = $request->file('image_path');
                                $filename = time().'_'.$file->getClientOriginalName();
                                $file->move(public_path('images'), $filename);
                                ProductImages::create([
                                    'product_id' => $request->id,
                                    'image_path' => 'images/'.$filename,
                                ]);
                            }
                            session()->flash('success', 'Product Update Successfully');

                            return redirect()->route('product');
                        } else {
                            $p = new Product;
                            $p->product_name = $request->product_name;
                            $p->description = $request->description;
                            $p->price = $request->price;
                            $p->discount_price = $request->discount_price;
                            $p->category_id = $request->category_id;
                            $p->stock = $request->stock;
                            $p->save();
                            if ($request->hasFile('image_path')) {
                                $file = $request->file('image_path');
                                $filename = time().'_'.$file->getClientOriginalName();
                                $file->move(public_path('images'), $filename);
                                // $p->image_path = 'images/' . $filename;
                                ProductImages::create([
                                    'product_id' => $p->id,
                                    'image_path' => 'images/'.$filename,
                                ]);
                            }
                            session()->flash('success', 'Product Added Successfully');

                            return redirect()->route('product');
                        }
                    }
                } catch (\Throwable $th) {
                    session()->flash('error', $th->getMessage());

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

    public function ProductExport(Request $request)
    {
        $query = Product::with('get_category');
        if ($request->product_name) {
            $query->where('product_name', 'LIKE', '%'.$request->product_name.'%' );
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->status != '') {
            $query->where( 'status',$request->status);
        }

        $products = $query->get();
        if ($request->type == 'excel') {
            return Excel::download(new ProductExport($products),'products.xlsx');
        }

        if ($request->type == 'pdf') {
            // dd($request->all());
            $pdf = Pdf::loadView('Export.pdf.product_pdf', ['product' => $products]);
            return $pdf->download('products.pdf');
        }
    }

    public function ProductList(Request $request)
    {
        $gender = session('user_gender');
        $categoryId = null;
        if ($gender == 'm') {
            $categoryId = Category::where('name', 'Man')->value('id');
        } elseif ($gender == 'f') {
            $categoryId = Category::where('name', 'Woman')->value('id');
        } else {
            $categoryId = Category::where('name', 'Kids')->value('id');
        }

        if ($request->ajax()) {
            if ($request->get_favourite) {

                $userId = session('user_id');
                $productId = $request->product_id;
                $fav = Favourites::where('user_id', $userId)->where('product_id', $productId)->first();
                if ($fav) {
                    $fav->delete();

                    return response()->json(['favourited' => false]);
                } else {
                    try {
                        Favourites::create([
                            'user_id' => $userId,
                            'product_id' => $productId,
                        ]);

                        return response()->json(['favourited' => true]);
                    } catch (\Throwable $th) {
                        return response()->json(['error' => $th->getMessage()], 500);
                    }
                }
            }
        }

        $data['products'] = Product::where('category_id', $categoryId)->get();
        $data['favouriteIds'] = Favourites::where('user_id', session('user_id'))->pluck('product_id')->toArray();

        return view('product.Product_list')->with($data);
    }
}

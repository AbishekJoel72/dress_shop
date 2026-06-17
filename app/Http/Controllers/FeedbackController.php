<?php

namespace App\Http\Controllers;

use App\Models\Favourites;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeedbackController extends Controller
{
    public function FavouritesList(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get_view_image) {
                $id = $request->id;
                $favourite = Favourites::with(['get_product', 'get_product.get_product_images'])->where('id', $id)->first();
                return response()->json($favourite);
            }

            $query = Favourites::with(['get_user', 'get_product', 'get_product.get_category', 'get_product.get_product_images']);
            if ($request->customer_name) {
                $query->whereHas('get_user',
                    function ($q) use ($request) {
                        $q->where('first_name', 'LIKE', '%'.$request->customer_name.'%');
                    }
                );
            }

            if ($request->email) {
                $query->whereHas('get_user',
                    function ($q) use ($request) { $q->where('email','LIKE','%'.$request->email.'%');}
                );

            }
            if ($request->phone_no) {
                $query->whereHas('get_user',
                    function ($q) use ($request) {
                        $q->where('phone_no','LIKE','%'.$request->phone_no.'%');
                    }
                );
            }

            if ($request->product_name) {
                $query->whereHas('get_product',
                    function ($q) use ($request) {
                        $q->where('product_name','LIKE','%'.$request->product_name.'%');
                    }
                );
            }

            if ($request->product_name) {
                $query->whereHas('get_product',
                    function ($q) use ($request) {
                        $q->where( 'product_name','LIKE','%'.$request->product_name.'%' );
                    }
                );
            }

            if ($request->category_name) {
                $query->whereHas('get_product.get_category',
                    function ($q) use ($request) {
                        $q->where( 'name','LIKE','%'.$request->category_name.'%');
                    }
                );
            }

            if ($request->from_date) {
                $from = Carbon::createFromFormat('d-m-Y',$request->from_date)->format('Y-m-d');
                $query->whereDate('created_at','>=', $from);
            }

            if ($request->to_date) {
                $to = Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d');
                $query->whereDate('created_at','<=',$to);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('added_date', function ($row) {
                    return $row->created_at;
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="dropdown">
                            <a href="#" class="text-dark"data-bs-toggle="dropdown"> <i class="fas fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)" class="ViewImage dropdown-item" data-id="'.$row->id.'"> View Image </a>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('feedback.favourites');
    }

    public function Feedback(Request $request)
    {
        $user = session('user_id');
        if ($request->method('POST')) {
            if ($request->feedbacks) {
                try {
                    $validation = $request->validate([
                        'subject' => 'required',
                        'rating' => 'required',
                        'comment' => 'required',
                    ]);
                    if ($validation) {
                        if ($request->id) {
                            Feedback::where('id', $request->id)->update([
                                'subject' => $request->subject,
                                'rating' => $request->rating,
                                'comment' => $request->comment,
                            ]);
                            session()->flash('success', 'Feedback Updated Sucessfully');

                            return redirect()->route('feedback');
                        } else {
                            $feedback = new Feedback;
                            $feedback->user_id = $user;
                            $feedback->subject = $request->subject;
                            $feedback->rating = $request->rating;
                            $feedback->comment = $request->comment;
                            $feedback->save();
                            session()->flash('success', 'Feedback Added Sucessfully');

                            return redirect()->route('feedback');
                        }
                    }
                } catch (\Throwable $th) {
                    session()->flash('error', 'Feedback Added Failed');

                    return redirect()->back();
                }
            }
        }
        $data['feedback_list'] = Feedback::where('user_id', $user)->first();
        if (! $data['feedback_list']) {
            $data['feedback_list'] = new Feedback;
        }

        return view('feedback.feedback')->with($data);
    }

    public function FeedbackList(Request $request)
    {
        if ($request->ajax()) {
            $data = Feedback::with('get_register')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($row) {
                    return $row->get_register->lastname ? $row->get_register->first_name.' '.$row->get_register->last_name : $row->get_register->first_name;
                })
                ->make(true);
        }

        return view('feedback.feedback_list');
    }
}

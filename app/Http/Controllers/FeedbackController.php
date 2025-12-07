<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeedbackController extends Controller
{


    public function Feedback(Request $request)
    {
        $user = session('user_id');

        if ($request->method("POST")) {
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
                            session()->flash("success", "Feedback Updated Sucessfully");
                            return redirect()->route("feedback");
                        } else {
                            $feedback  = new Feedback();
                            $feedback->user_id = $user;
                            $feedback->subject = $request->subject;
                            $feedback->rating = $request->rating;
                            $feedback->comment = $request->comment;
                            $feedback->save();

                            session()->flash("success", "Feedback Added Sucessfully");
                            return redirect()->route("feedback");
                        }
                    }
                } catch (\Throwable $th) {
                    session()->flash("error", "Feedback Added Failed");
                    return redirect()->back();
                }
            }
        }

        $data['feedback_list'] = Feedback::where('user_id', $user)->first();
        if (!$data['feedback_list']) {
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
                    return $row->get_register->lastname ? $row->get_register->first_name . ' ' . $row->get_register->last_name : $row->get_register->first_name;
                })
                ->make(true);
        }

        return view('feedback.feedback_list');
    }
}

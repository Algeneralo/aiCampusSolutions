<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record = [
            'parent_id' => decrypt($request->input('parent_id')),
            'subject' => $request->input('add_modal_subject'),
            'info' => $request->input('add_modal_info'),
            'link1' => $request->input('add_modal_link1'),
            'link2' => $request->input('add_modal_link2'),
            'link3' => $request->input('add_modal_link3'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        try {
            $status = DB::table('questions')->insert($record);

        } catch (\Exception $exception) {
            if ($request->ajax()) {
                return ['status' => 500, 'msg' => 'Internal server error'];
            }
            return redirect()->back()->with([
                'error' => 'Error! Internal server error',
                'msg' => 'Please try again'
            ]);
        }

        if ($status) {
            if ($request->ajax()) {
                return ['status' => 204, 'msg' => 'Question added successfully'];
            }
            return redirect()->back()->with('success', 'Question added successfully');
        }

        if ($request->ajax()) {
            return ['status' => 500, 'msg' => 'something went wrong'];
        }
        return redirect()->back()->with([
            'error' => 'Error! something went wrong',
            'msg' => 'Please try again'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //26497 it's just a key to hide the real ids
        $id = $id - 26497;
        $data['title']="Questions";
        $data['table'] = \App\QuestionCategory::find($id);
        $data['questions'] = DB::table('questions')->where('parent_id', $id)->orderBy('subject', 'asc')->paginate(8);
        $data['parent_id'] = encrypt($id);
        return view('Admin.Questions.questions', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->link1 == '-')
                $request->link1 = Null;
            if ($request->link2 == '-')
                $request->link2 = Null;
            if ($request->link3 == '-')
                $request->link3 = Null;
            $record = [
                'subject' => $request->subject,
                'info' => $request->info,
                'link1' => $request->link1,
                'link2' => $request->link2,
                'link3' => $request->link3,
                'updated_at' => Carbon::now()
            ];
            try {
                $status = DB::table('questions')->where('id', decrypt($id))->update($record);
            } catch (\Exception $exception) {
                if ($request->ajax()) {
                    return ['status' => 500, 'msg' => 'Internal server error'];
                }
                return parent::response_header(500, 'null', 'internal server error');
            }
            if ($status >= 1) {
                if ($request->ajax()) {
                    return ['status' => 204, 'msg' => 'Question added successfully'];
                }
                return parent::response_header(204, 'null', 'Updated successfully');
            }
            if ($request->ajax()) {
                return ['status' => 500, 'msg' => 'something went wrong'];
            }
            return parent::response_header(500, 'null', 'somethings went wrong');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $status = DB::table('questions')->where('id', decrypt($id))->delete();
        } catch (\Exception $exception) {
            return parent::response_header(500, Null, 'internal server error');
        }
        if ($status >= 1)
            return parent::response_header(204, Null, 'Deleted successfully');
        return parent::response_header(500, Null, 'Something went wrong');
    }
}

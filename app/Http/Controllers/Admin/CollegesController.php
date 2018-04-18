<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CollegesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Colleges";
        $data['colleges'] = DB::table('colleges')->orderBy('name', 'asc')->paginate(8);
        return view('Admin.Colleges.colleges', $data);
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
        try {
            $status = DB::table('colleges')->insert(
                [
                    'name' => $request->add_modal_college,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        } catch (\Exception $exception) {
            return redirect()->back()->with([
                'error' => 'Error! Internal server error',
                'msg' => 'Please try again'
            ]);
        }

        if ($status)
            return redirect()->back()->with('success', 'College added successfully');
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
        $data['tables'] = DB::table('question_category')->where('college_id', $id)->orderBy('name', 'asc')->paginate(8);
        $data['parent_id'] = encrypt($id);
        return view('Admin.Colleges.colleges', $data);
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
            try {
                $record = [
                    'name' => $request->college,
                    'updated_at' => Carbon::now()
                ];
                $status = DB::table('colleges')->where('id', decrypt($id))->update($record);
            } catch (\Exception $exception) {
                return parent::response_header(500, null, 'internal server error');
            }
            if ($status >= 1)
                return parent::response_header(204, Null, 'Updated successfully');
            return parent::response_header(501, Null, 'Something went wrong');

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
            $status = DB::table('colleges')
                ->where('id', decrypt($id))
                ->delete();
        } catch (\Exception $exception) {
            return parent::response_header(500, null, 'internal server error');
        }
        if ($status >= 1)
            return parent::response_header(204, Null, 'deleted successfully');
        return parent::response_header(501, Null, 'Something went wrong');
    }
}

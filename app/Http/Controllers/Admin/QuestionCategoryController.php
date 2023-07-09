<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $data['title'] = "Question Category";
        $data['questionsCategory'] = DB::table('question_category')
            ->join('colleges', 'colleges.id', '=', 'question_category.college_id')
            ->select('question_category.*', 'colleges.name as college_name')
            ->orderBy('college_name', 'asc')
            ->paginate(8);
        $data['colleges1'] = DB::table('colleges')->get();
        return view('Admin.QuestionCategory.questionCategory1', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = "Admin";
        $data['questionsCategory'] = DB::table('question_category')
            ->join('colleges', 'colleges.id', '=', 'question_category.college_id')
            ->select('question_category.*', 'colleges.name as college_name')
            ->where('college_id', $id - 26497)
            ->orderBy('question', 'asc')
            ->paginate(8);
        $data['colleges'] = DB::table('colleges')->get();
        return view('Admin.QuestionCategory.questionCategory', $data);
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
            $college_id = $request->college - 26497;
            try {
                $record = [
                    'question' => $request->question,
                    'college_id' => $college_id,
                    'updated_at' => Carbon::now()
                ];
                $status = DB::table('question_category')->where('id', decrypt($id))->update($record);
            } catch (\Exception $exception) {
                return parent::response_header(500, null, 'internal server error');
            }
            if ($status >= 1)
                return parent::response_header(204, Null, 'Updated successfully');
            return parent::response_header(500, Null, 'Something went wrong');

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
            $status = DB::table('question_category')->where('id', decrypt($id))->delete();
        } catch (\Exception $exception) {
            return parent::response_header(500, Null, 'internal server error');
        }
        if ($status >= 1)
            return parent::response_header(204, Null, 'Deleted successfully');
        return parent::response_header(500, Null, 'Something went wrong');
    }
}

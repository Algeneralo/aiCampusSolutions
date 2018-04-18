<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function studentSearch(Request $request)
    {
        if ($request->input()) {
            $data['title'] = "IVC Search";
            $data['questionsCategory'] = DB::table('question_category')
                ->where('college_id', $request->input('college_id'))
                ->get();
            return view('student.search', $data);
        }
        $data['colleges'] = DB::table('colleges')->get();
        return view('student.', $data);

    }

    public function IVCStudent()
    {
        $data['title'] = "IVC Search";
        $data['questionsCategory'] = DB::table('question_category')->where('college_id', '2')->get();
        $data['college'] = DB::table('colleges')->where('id', '2')->get()[0];
        return view('student.search', $data);
    }

    public function NTCStudent()
    {
        $data['title'] = "NTC Search";
        $data['questionsCategory'] = DB::table('question_category')->where('college_id', '1')->get();
        $data['college'] = DB::table('colleges')->where('id', '1')->get()[0];
        return view('student.search', $data);
    }

    public function ajaxData(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data['questions'] = DB::table('questions')
                    ->join('question_category', 'question_category.id', '=', 'questions.parent_id')
                    ->where('college_id', $request->college_id)
                    ->where('subject', 'like', '%' . $request->keyword . '%')
                    ->select('question_category.question as questionCategory', 'questions.*')
                    ->get();
            } catch (\Exception $exception) {
                return parent::response_header(500, Null, 'internal server error');
            }
            if (count($data['questions']) > 0) {
                $html = view('student.ajaxRenderView.searchData', $data)->render();
                return parent::response_header(200, $html, 'Data found');
            } else {
                return parent::response_header(204, [], 'No Data found');
            }
        }
        return redirect()->back();
    }

    public function autoComplete(Request $request)
    {
        $data = DB::table('questions')
            ->join('question_category', 'question_category.id', '=', 'questions.parent_id')
            ->where('college_id', $request->college_id)
            ->where('subject', 'like', '%' . $request->data['term'] . '%')
            ->take(5)
            ->pluck('subject');
        return response()->json($data);

    }
}

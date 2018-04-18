<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SuggestionEditTypeController extends Controller
{
    public function index()
    {
        $data['title'] = "Suggestions";
        $data['students'] = DB::table('students')
            ->join('suggestions', 'suggestions.student_id', '=', 'students.id')
            ->join('colleges', 'colleges.id', '=', 'students.college_id')
            ->select('students.*', 'colleges.name as college_name')
            ->where('suggestions.question_id', '!=', '0')
            ->groupBy('students.id')
            ->paginate(5);

        for ($counter = 0; $counter < count($data['students']); $counter++) {
            $data['students'][$counter]->suggestions = DB::table('suggestions')
                ->join('questions', 'questions.id', '=', 'suggestions.question_id')
                ->select('questions.subject as old_subject', 'questions.info as old_info', 'questions.link1 as old_link1',
                    'questions.link2 as old_link2', 'suggestions.*')
                ->where('suggestions.student_id', $data['students'][$counter]->id)
                ->where('suggestions.question_id', '!=', '0')
                ->get();
        }

        return view('Admin.Suggestions.editSuggestion', $data);
    }

    public function approveSuggestion(Request $request)
    {

        if ($request->ajax()) {
            try {
                $status = app('App\Http\Controllers\Admin\QuestionController')->update($request, $request->question_id);
                if ($status['status'] == 500)
                    return parent::response_header(500, $status, 'Internal server error');
                else {
                    $status = DB::table('suggestions')
                        ->where('id', decrypt($request->input('suggestion_id')))
                        ->delete();
                    if ($status > 0) {
                        Mail::to($request->input('student_email'))->send(new \App\Mail\approvalMail());
                        return parent::response_header(204, null, 'Suggestion added successfully');
                    }
                }
            } catch
            (\Exception $exception) {
                return parent::response_header(500, null, 'Internal server error');
            }
        }
        return redirect()->back();

    }

    public function rejectSuggestion(Request $request)
    {
        if ($request->ajax()) {
            try {
                $status = DB::table('suggestions')
                    ->where('id', decrypt($request->input('suggestion_id')))
                    ->delete();
                if ($status > 0)
                    return parent::response_header(204, null, 'Suggestion deleted successfully');

            } catch (\Exception $exception) {
                return parent::response_header(500, null, 'Internal server error');
            }
        }
        return redirect()->back();
    }
}

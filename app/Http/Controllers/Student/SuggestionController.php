<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Students;

class suggestionController extends Controller
{
    public function __invoke(Request $request)
    {

        $request->validate(['name' => 'required',
            'email' => 'required|email',
            'department' => 'required',
            'ext' => 'required',]);
        //if there is no data to edit it
        if (count($request->input('subject')) == 0)
            return redirect()->back()->with('warning', 'Please choose data to edit it!');
        try {

            //find student by his email or create new one and get data
            $student = Students::firstOrCreate(
                ['email' => $request->input('email')],
                ['college_id' => decrypt($request->input('college_id')),
                    'name' => $request->input('name'),
                    'department' => $request->input('department'),
                    'ext' => $request->input('ext'),]
            );

            //if there is more than one items to add it (array of suggestions)
            if (count($request->input('subject')) > 1) {
                for ($counter = 0;
                     $counter < count($request->input('subject'));
                     $counter++) {
                    $record = ['question_id' => $request->input('id')[$counter] != null ? decrypt($request->input('id')[$counter]) : 0,
                        'questionCategory_id' => $request->input('parent_id')[$counter] != null ? decrypt($request->input('parent_id')[$counter]) : 0,
                        'student_id' => $student->id,
                        'subject' => preg_replace('/\s+/', ' ', $request->input('subject')[$counter]),
                        'info' => preg_replace('/\s+/', ' ', $request->input('info')[$counter]),
                        'link1' => preg_replace('/\s+/', ' ', $request->input('link1')[$counter]),
                        'link2' => preg_replace('/\s+/', ' ', $request->input('link2')[$counter]),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),];
                    $status = DB::table('suggestions')->insert($record);
                }
            } //if there is only one suggestion
            else {
                $question_id = 0;
                $questionCategory_id = 0;
                if (gettype($request->input('id')) == 'array' && $request->input('id') != null)
                    $question_id = decrypt($request->input('id')[0]);
                elseif (gettype($request->input('id')) != 'array' && $request->input('id') != null)
                    $question_id = decrypt($request->input('id')[0]);

                if (gettype($request->input('parent_id')) == 'array' && $request->input('parent_id') != null)
                    $questionCategory_id = decrypt($request->input('parent_id')[0]);
                elseif (gettype($request->input('parent_id')) != 'array' && $request->input('parent_id') != null)
                    $questionCategory_id = decrypt($request->input('parent_id'));

                $record = [
                    'question_id' => $question_id,
                    'questionCategory_id' => $questionCategory_id,
                    'student_id' => $student->id,
                    'subject' => gettype($request->input('subject')) == 'array' ? preg_replace('/\s+/', ' ', $request->input('subject')[0]) : preg_replace('/\s+/', ' ', $request->input('subject')),
                    'info' => gettype($request->input('info')) == 'array' ? preg_replace('/\s+/', ' ', $request->input('info')[0]) : preg_replace('/\s+/', ' ', $request->input('info')),
                    'link1' => gettype($request->input('link1')) == 'array' ? preg_replace('/\s+/', ' ', $request->input('link1')[0]) : preg_replace('/\s+/', ' ', $request->input('link1')),
                    'link2' => gettype($request->input('link2')) == 'array' ? preg_replace('/\s+/', ' ', $request->input('link2')[0]) : preg_replace('/\s+/', ' ', $request->input('link2')),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                $status = DB::table('suggestions')->insert($record);
            }
            if ($status) {
                Mail::to($request->input('email'))->send(new \App\Mail\suggestionMail());
                return redirect()->back()->with('success', 'Suggestion sent successfully');
            }
        } catch
        (\Exception $exception) {
            return redirect()->back()->with([
                'error' => 'Error! Internal server error',
                'msg' => 'Please try again'
            ]);
        }


        return redirect()->back()->with([
            'error' => 'Error! something went wrong',
            'msg' => 'Please try again'
        ]);
    }
}

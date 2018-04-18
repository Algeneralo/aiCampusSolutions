<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class spreadsheetController extends Controller
{

    public function __invoke(Request $request)
    {

        if ($request->input()) {
            $request->validate([
                'college' => 'required',
                'QuestionCategory' => 'required',
            ]);

            $record = [
                'question' => $request->input('QuestionCategory'),
                'college_id' => decrypt($request->input('college')),
            ];

            $parent_id = \App\QuestionCategory::create($record);
            $result = $this->extractExcelData($request->file('spreadsheet'), $parent_id->id);
            if (isset($result['error']) || $result == false) {
                \App\QuestionCategory::where('id', $parent_id->id)->delete();
                return redirect()->back()->with([
                    'error' => $result['error'] ?? 'Error! failed to insert question',
                    'msg' => $result['msg'] ?? 'please try again'
                ]);
            }
            return redirect('\questionCategory')->with('success', 'Spreadsheet uploaded successfully');

        }
        $data['title'] = 'Upload Spreadsheet';
        $data['colleges'] = \App\Colleges::all();
        return view('Admin.uploadSpreadsheet', $data);
    }

    private function extractExcelData($file, $parent_id)
    {
        $boolean = false;

        try {
            $path = $file->getRealPath();
            $data = \Excel::selectSheetsByIndex(0)->load($path)->get();

            foreach ($data as $key => $v) {
                if (trim($v['subject']) != '' && trim($v['info']) != '')
                    $boolean = DB::table('questions')->insert(
                        [
                            'parent_id' => $parent_id,
                            'subject' => preg_replace('/\s+/', ' ', $v['subject']),
                            'info' => preg_replace('/\s+/', ' ', $v['info']),
                            'link1' => preg_replace('/\s+/', ' ', $v['link1'] ?? "No link1 Found"),
                            'link2' => preg_replace('/\s+/', ' ', $v['link2'] ?? ""),
                            'link3' => preg_replace('/\s+/', ' ', $v['link3'] ?? ""),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]
                    );
            }
        } catch (\ErrorException $exception) {
            //Error is the error herder,msg is the message for Error
            return [
                'error' => 'Error! Please check the excel file header',
                'msg' => 'It must be exactly like that: subject | info | link1 | link2 | link3'
            ];
        } catch (\Exception $exception) {
            return [
                'error' => 'Error! Internal server error',
                'msg' => 'Please try again'
            ];
        }

        return $boolean;
    }
}

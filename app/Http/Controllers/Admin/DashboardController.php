<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $data['title'] = 'Dashboard';
        $data['colleges'] = DB::table('colleges')->count();
        $data['suggestions'] = DB::table('suggestions')->count();
        $data['questionCategory'] = DB::table('question_category')->count();
        $data['questions'] = DB::table('questions')->count();

        return view('Admin.dashboard', $data);
    }
}

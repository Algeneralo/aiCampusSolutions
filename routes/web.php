<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', function () {
    return redirect('login');
});

Route::get('NTCStudent', 'Student\SearchController@NTCStudent');
Route::get('IVCStudent', 'Student\SearchController@IVCStudent');
Route::get('SearchDataAjax', 'Student\SearchController@ajaxData')->name('ajaxSearchData');
Route::get('autoCompleteAjax', 'Student\SearchController@autoComplete');
Route::post('Suggestion', 'Student\SuggestionController');
Route::get('Suggestion', 'Student\SuggestionController');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'Admin\DashboardController');
    Route::resource('colleges', 'Admin\CollegesController');
    Route::resource('questions', 'Admin\QuestionController');
    Route::resource('questionCategory', 'Admin\QuestionCategoryController');
    Route::match(['get', 'post'], 'uploadSpreadsheet', 'Admin\SpreadsheetController');
    Route::get('SuggestionAddType', 'Admin\SuggestionAddTypeController@index');
    Route::post('approveAddSuggestion', 'Admin\SuggestionAddTypeController@approveSuggestion');
    Route::post('rejectAddSuggestion', 'Admin\SuggestionAddTypeController@rejectSuggestion');
    Route::get('SuggestionEditType', 'Admin\SuggestionEditTypeController@index');
    Route::post('approveEditSuggestion', 'Admin\SuggestionEditTypeController@approveSuggestion');
    Route::post('rejectEditSuggestion', 'Admin\SuggestionEditTypeController@rejectSuggestion');
});

//admin123@A

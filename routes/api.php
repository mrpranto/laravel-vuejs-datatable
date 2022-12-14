<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('class-info', [StudentController::class, 'classInfos']);
Route::get('students', [StudentController::class, 'students']);
Route::get('download-pdf', [StudentController::class, 'downloadPDF']);
Route::get('download-excel', [StudentController::class, 'downloadExcel']);
Route::get('download-csv', [StudentController::class, 'downloadCSV']);

Route::post('upload-files', [StudentController::class, 'uploadFiles']);

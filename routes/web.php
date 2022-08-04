<?php
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('fetch-students', [StudentController::class, 'fetchstudent']);
Route::get('edit-students/{id}',  [StudentController::class, 'edit'] );
Route::put('update-student/{id}', [StudentController::class, 'update']);
Route::delete('delete-students/{id}', [StudentController::class, 'destroy']);

Route::get('/', function () {
    return view('welcome');
});

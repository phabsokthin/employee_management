<?php

use App\Http\Controllers\AttandanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['employee'], function () {

    Route::post("/employee_post", [EmployeeController::class, 'save_employee'])->name("save_employee");
    Route::get("/delete/{id}", [EmployeeController::class, 'delete_employee'])->name("delete_emp");
    Route::post('/upldate/{id}', [EmployeeController::class, 'update_employee'])->name("emp_update");
});

Route::controller(PositionController::class)->group(function () {
    Route::get("/position", 'index_position')->name("position");
    Route::post('/save_position', 'save_position')->name("save_position");
    Route::get("/delete_po/{id}", 'delete_pos')->name('delete_pos');
    Route::post('/update/{id}', 'update_pos')->name("update_pos");
});

Route::controller(AttandanceController::class)->group(function () {
    Route::get('/index_pos', 'attace_pos')->name('attace_pos');
    Route::post('/save_control', 'save_att')->name('save_attancedance');
    Route::get("/delete_at/{id}", 'delete_att')->name('delete_att');
    Route::post('/update_att/{id}', 'update_att')->name('update_att');
});

Route::controller(SalaryController::class)->group(function () {
    Route::get('/salray', 'salary')->name("salary");
    Route::post('/save_salary', 'save_salary')->name('save_salary');
    Route::get("/delete_salary/{id}", 'delete_salary')->name("delete_salary");
    Route::post("/update_salary/{id}", 'update_salary')->name("update_salary");
});

Route::controller(HistoryController::class)->group(function () {
    Route::get('/history', 'fetch_his')->name('history');
    Route::post('/history_save', 'save_history')->name('save_history');
    Route::get('/delete_history/{id}', 'delete_history')->name('delete_history');
    Route::post('/update_history/{id}', 'update_history')->name('update_history');
    Route::get('/view_emp/{id}', 'view_detail')->name('view_detail');
});
Route::get('/', [AuthController::class, 'login_index'])->name('login_index');
//register
Route::get('/register', [AuthController::class, 'register'])->name("register");
Route::post('/register_post', [AuthController::class, 'register_post'])->name('register_post');
Route::group(['middleware' => 'guest'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login_post');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get("/emp_index", [EmployeeController::class, 'index'])->name('index');
    Route::delete('/login_index', [AuthController::class, 'logout'])->name('logout');
});

<?php

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



Auth::routes();
Route::get('/dash', [App\Http\Controllers\DashController::class, 'index'])->middleware('auth');
Route::get('/register', function() {
    return redirect('/');
});

Route::get('/', [App\Http\Controllers\SubjectsController::class, 'index']);

Route::get('/gradeselector', [App\Http\Controllers\GradesController::class, 'selector']);
Route::get('/list-guides', [App\Http\Controllers\Study_guidesController::class, 'list']);
Route::get('/view-guide/{study_guide}', [App\Http\Controllers\Study_guidesController::class, 'view']);

Route::get('/about', function () {
   return view('about.about');
});
Route::get('/ASZF', function () {
   return view('about.aszf');
});
Route::get('/copyright', function () {
   return view('about.copyright');
});
Route::get('/donate', function () {
    return view('about.support');
});
Route::get('/finance', function () {
    return view('about.finance');
});


Route::post('/newguide', [App\Http\Controllers\DashController::class, 'upload'])->middleware('auth');
Route::post('/editview', [App\Http\Controllers\Study_guidesController::class, 'editview'])->middleware('auth');
Route::put('/edit/{id}', [App\Http\Controllers\Study_guidesController::class, 'edit'])->middleware('auth');
Route::delete('/delete/{id}', [App\Http\Controllers\Study_guidesController::class, 'delete'])->middleware('auth');

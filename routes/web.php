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
Route::post('/release-upgrade', [App\Http\Controllers\DashController::class, 'releaseUpgrade'])->middleware('auth');

/*
Store
*/

Route::get('/store', [App\Http\Controllers\StoreController::class, 'index']);
Route::get('/store/item/{store}', [App\Http\Controllers\StoreController::class, 'show']);

Route::prefix('/cart')->group(function () {
    Route::get('/', [App\Http\Controllers\CartController::class, 'index']);
    Route::post('/add', [App\Http\Controllers\CartController::class, 'add']);
    Route::put('/update/{itemId}', [App\Http\Controllers\CartController::class, 'update']);
    Route::delete('/remove/{itemId}', [App\Http\Controllers\CartController::class, 'remove']);
    Route::delete('/clear', [App\Http\Controllers\CartController::class, 'clear']);
});

Route::prefix('/checkout')->group(function () {
    Route::get('/', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout');
    Route::post('/', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/order/confirmation/{order_number}', function ($orderNumber) {
    $order = \App\Models\Order::where('order_number', $orderNumber)->firstOrFail();
    return view('store.order-confirmation', compact('order'));
})->name('order.confirmation');

Route::prefix('/store/admin')->middleware('auth')->group(function() {
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'update'])->name('admin.orders.update');
    Route::post('/orders/{order}/pickup', [\App\Http\Controllers\OrderController::class, 'sendPickupDate'])->name('admin.orders.pickup');
    Route::post('/orders/{order}/tracking', [\App\Http\Controllers\OrderController::class, 'sendTrackingNumber'])->name('admin.orders.tracking');
    Route::patch('/orders/{order}/archive', [\App\Http\Controllers\OrderController::class, 'archive'])->name('admin.orders.archive');
});

/* Image Uploads */
Route::get('/images', [App\Http\Controllers\ImgUploadsController::class, 'list'])->middleware('auth');
Route::post('/images', [App\Http\Controllers\ImgUploadsController::class, 'upload'])->middleware('auth');
Route::delete('/images', [App\Http\Controllers\ImgUploadsController::class, 'delete'])->middleware('auth');

Route::delete('/manage-images/{filename}', [App\Http\Controllers\ImgUploadsController::class, 'apiImageDelete'])->name('images.destroy');


/*
    New routes
*/
Route::get('/{subject}', [App\Http\Controllers\GradesController::class, 'list']);
Route::get('/{subject}/{grade}', [App\Http\Controllers\Study_guidesController::class, 'listBySlug']);
Route::get('/{subject}/{grade}/{guide}', [App\Http\Controllers\Study_guidesController::class, 'viewBySlug']);
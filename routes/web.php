<?php
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
// Welcome Route
Route::get('/', function () {
    return view('welcome');
});
// Laravel Breeze Routes
require __DIR__.'/auth.php';
// Dashboard Route accessible to guests
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');
// Authenticated and Verified Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Upload Routes
    Route::get('/uploads', [UploadController::class, 'uploadindex'])->name('uploadindex');
    Route::get('/uploads/create', [UploadController::class, 'uploadcreate'])->name('uploadcreate');
    Route::post('/uploads', [UploadController::class, 'uploadstore']);
    Route::get('/uploads/{upload}/edit', [UploadController::class, 'uploadedit']);
    Route::get('/uploads/{upload}/{origName?}', [UploadController::class, 'uploadshow']);
    Route::delete('/uploads/{upload}', [UploadController::class, 'uploaddestroy']);
    Route::put('/uploads/{upload}', [UploadController::class, 'uploadupdate']);
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/feedback', [FeedbackController::class, 'showForm'])->name('feedback.form');
    Route::get('/feedback', [FeedbackController::class, 'showAllFeedback'])->name('feedback.index');
// 管理员可以查看所有反馈
Route::get('/feedback/all', [FeedbackController::class, 'showAllFeedbackForAdmin'])->name('feedback.all')->middleware('can:viewAny,App\Models\Feedback');
});
Route::middleware(['admin'])->group(function () {
    Route::get('/make-admin/{userId}', [UserController::class, 'makeAdmin']);
 });



<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CommentController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [FeedbackController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::post('/feedback/vote', [FeedbackController::class, 'vote'])->name('feedback.vote');
    Route::get('/comment/{id}', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/reply/comment', [CommentController::class, 'Comment'])->name('reply.create');

});
require __DIR__.'/auth.php';

Route::get('/admin/dashboard', [FeedbackController::class, 'adminindex'])
->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/profile', [ProfileController::class, 'admin_edit'])->name('profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   Route::get('admin/feedbackview/{id}', [CommentController::class, 'feedbackview'])->name('admin.feedback.view');
   Route::post('admin/feedbackview/comment/enable', [CommentController::class, 'enablecomment']);
   Route::delete('admin/feedback/delete/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
   Route::post('admin/feedback/Enable', [FeedbackController::class, 'enablefeedback']);
});

require __DIR__.'/adminauth.php';



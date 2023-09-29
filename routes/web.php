<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\Table\DifferentController;
use App\Http\Controllers\Table\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\User\UserController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
Route::group(['middleware' => ['set_locale']], function () {
// CHECK DB
Route::get('/checkdb', function () {
    try {
        DB::connection()->getPdo();
        return 'Соединение с базой данных установлено.';
    } catch (\Exception $e) {
        return 'Не удалось подключиться к базе данных: ' . $e->getMessage();
    }
});

// Route::view('/', 'home.index')->name('home');
// Route::view('/home', '/')->name('home.redirect');

Auth::routes(['verify' => true]);

Route::get('login.password_reset', [ForgotPasswordController::class, 'index'])->name('password.reset');
Route::post('login.password_reset', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.forgot');
Route::get('change.change_password{id}', [ForgotPasswordController::class, 'passwordChange'])->name('password.change');
Route::get('/redirect-to-message', [ForgotPasswordController::class, 'redirectToMessage'])->name('redirect-to-message');
Route::get('/redirect-to-message_r', [RegisterController::class, 'redirectToMessage'])->name('redirect-to-message_r');
Route::post('/update-password', [ForgotPasswordController::class, 'updatePassword'])->name('updatePassword');

Route::get('/', function () {
    return redirect('home');
});

Route::get('locale/{locale}', [LocaleController::class, 'changeLocale'])->name('locale');

Route::middleware('guest',)->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

// EXIT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// CHANGE PASSWORD
Route::get('change', [UserController::class, 'index'])->name('change');
Route::post('/change-update', [UserController::class, 'update'])->name('change-update');

// PROCEDURES AT HOME PAGE
Route::get('home', [DifferentController::class, 'indexProceduresHome'])->name('home');

// WORK WITH BLOG

Route::group(['middleware' => ['auth', 'active', 'admin']], function () {
    Route::delete('post.photos.delete', [BlogController::class, 'deletePostPhotos'])->name('post.photos.delete');

    Route::delete('comment.delete', [CommentController::class, 'deleteComment'])->name('comment.delete');
});

Route::group(['middleware' => ['auth', 'active']], function () {
    Route::get('blog', [BlogController::class, 'index'])->name('blog')->middleware('checkUserRole');
    Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('blog/{post}/like', [BlogController::class, 'like'])->name('blog.like');

    Route::post('blog.creat.comment/{post_id}', [CommentController::class, 'createComment'])->name('blog.create.comment');
});

// Mistake BACK
// Route::fallback(function () {
//     return view('home.index');
// });
});

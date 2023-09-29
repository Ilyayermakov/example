<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// admin
Route::prefix('admin')->middleware(['auth', 'active', 'admin'])->group(function () {
    Route::redirect('/', 'admin/posts')->name('admin');
    Route::get('posts', [PostController::class, 'index'])->name('admin.posts');
    Route::get('posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');

    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('admin.posts.like');

    Route::get('change.admin', [UserController::class, 'indexUsers'])->name('change.admin');
    Route::post('change.admin.update{id}', [UserController::class, 'updateUser'])->name('change.admin.updateUser');
    Route::delete('change.admin.delete{id}', [UserController::class, 'deleteActivity'])->name('change.admin.deleteActivity');
    Route::delete('/delete-all', [UserController::class, 'deleteAll'])->name('delete.all');

    

    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.delete');
});

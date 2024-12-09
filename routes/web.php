<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\{RedirectIfNotAuthenticated,RedirectIfAuthenticated};
use App\Http\Controllers\{HomeController,AccountController,JobsController};

Route::get('/',[HomeController::class,'index']);
Route::get('regiser/account',[AccountController::class,'index']);
    Route::post('process-regiser/account',[AccountController::class,'processRegistration']);
    Route::get('login/account',[AccountController::class,'login'])->name('login');
    Route::get('logout',[AccountController::class,'logout']);

    Route::post('authenticate',[AccountController::class,'authenticate'])->name('auth');
    Route::get('profile',[AccountController::class,'profile'])->name('account.profile');
    Route::post('profile-update',[AccountController::class,'updateProfile'])->name('profile.update');
    Route::post('update-profile-image',[AccountController::class,'updateProfileImage'])->name('account.profileImage');

    Route::get('create-jobs',[AccountController::class,'createJob'])->name('create.jobs');
    Route::post('save-job',[AccountController::class,'saveJobs'])->name('save.job');
    Route::get('my-jobs',[AccountController::class,'myjobs'])->name('my.jobs');
    Route::get('edit-job/{id}',[AccountController::class,'editJob'])->name('edit.job');
    Route::post('update-job/{id}',[AccountController::class,'updateJob'])->name('update.job');
    Route::get('delete-job/{id}',[AccountController::class,'deleteJob'])->name('delete.job');

    Route::get('all-jobs',[JobsController::class,'index'])->name('all.jobs');
    Route::get('job-detail/{id}',[JobsController::class,'jobDetails'])->name('job.details');



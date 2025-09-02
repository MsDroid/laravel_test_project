<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Auth::routes(['verify'=>true]);

// Registration
Route::get('register/applicant',[RegisterController::class,'showRegistrationForm'])->name('register.applicant');
Route::post('register/applicant',[RegisterController::class,'register'])->name('register.applicant.post');

// Applicant dashboard & steps
// Route::group(['middleware'=>['auth','verified']], function(){
//     Route::get('/applicant/dashboard', [ApplicantController::class,'dashboard'])->name('applicant.dashboard');
//     Route::post('/applicant/payment', [ApplicantController::class,'savePayment'])->name('applicant.payment');
//     Route::post('/applicant/personal', [ApplicantController::class,'savePersonal'])->name('applicant.personal');
//     Route::post('/applicant/education', [ApplicantController::class,'saveEducation'])->name('applicant.education');
//     Route::post('/applicant/documents', [ApplicantController::class,'uploadDocuments'])->name('applicant.documents');
//     Route::post('/applicant/submit', [ApplicantController::class,'submitApplication'])->name('applicant.submit');
//     Route::get('/applicant/preview/{id}', [ApplicantController::class,'preview'])->name('applicant.preview');
// });


// Admin Routes
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pending', [AdminController::class, 'pendingForms'])->name('admin.pending');
    Route::get('/applicant/{id}', [AdminController::class, 'viewApplicant'])->name('admin.applicant.view');
    Route::post('/applicant/{id}/approve', [AdminController::class, 'approveApplicant'])->name('admin.applicant.approve');
});

// applicant routes
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/applicant/dashboard', [ApplicantController::class, 'dashboard'])->name('applicant.dashboard');

    Route::post('/applicant/payment', [ApplicantController::class, 'savePayment'])
        ->middleware('check.step:payment')
        ->name('applicant.payment');

    Route::post('/applicant/personal', [ApplicantController::class, 'savePersonal'])
        ->middleware('check.step:personal')
        ->name('applicant.personal');

    Route::post('/applicant/education', [ApplicantController::class, 'saveEducation'])
        ->middleware('check.step:education')
        ->name('applicant.education');

    Route::post('/applicant/experience', [ApplicantController::class, 'saveExperience'])
    ->middleware('check.step:experience')
    ->name('applicant.experience');

    Route::post('/applicant/documents', [ApplicantController::class, 'uploadDocuments'])
        ->middleware('check.step:documents')
        ->name('applicant.documents');

    Route::post('/applicant/submit', [ApplicantController::class, 'submitApplication'])
        ->middleware('check.step:submit')
        ->name('applicant.submit');

    Route::get('/applicant/preview/{id}', [ApplicantController::class, 'preview'])
        ->middleware('check.step:preview')
        ->name('applicant.preview');
});


// Admin
Route::prefix('admin')->middleware(['auth','can:admin'])->group(function(){
    Route::get('/applications/pending', [AdminApplicationController::class,'indexPending'])->name('admin.applications.pending');
    Route::get('/applications/{id}', [AdminApplicationController::class,'show'])->name('admin.applications.show');
    Route::post('/applications/{id}/approve', [AdminApplicationController::class,'approve'])->name('admin.applications.approve');
    Route::post('/applications/{id}/reject', [AdminApplicationController::class,'reject'])->name('admin.applications.reject');
});


require __DIR__.'/auth.php';

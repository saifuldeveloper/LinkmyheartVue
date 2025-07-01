<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MatchesController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Forntend routes


Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/pricing', [PagesController::class, 'pricing'])->name('pricing');
Route::get('/faq', [PagesController::class, 'faq'])->name('faq');
Route::get('/support', [PagesController::class, 'support'])->name('support');
Route::get('/filtering', [PagesController::class, 'filtering'])->name('filtering');

Route::middleware('guest')->group(function () {
    Route::get('/login', [PagesController::class, 'loginSection'])->name('loginsection');
    Route::post('/login-user', [PagesController::class, 'loginUser'])->name('login.user');
   
});

// user register otp send route
Route::post('/register-otp', [AuthController::class, 'registerOtp'])->name('register.otp');
Route::post('/register-otp-verify', [AuthController::class, 'registerOtpVerify'])->name('register.otp.verify');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');



Route::middleware('auth')->group(function () {
    Route::post('/logout-user', [PagesController::class, 'logoutUser'])->name('logout.user');

    Route::get('/dashboard', function () {
        return Inertia::render('Frontend/Pages/User/Dashboard');
    })->name('dashboard');
});



Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/partner-preference', [UserProfileController::class, 'partnerPreference'])->name('partner.preference');
        Route::post('/partner-preference/update', [MatchesController::class, 'partnerPreferenceUpdate'])->name('partner.preference.update');
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/upload-profile-image', [UserProfileController::class, 'uploadImage'])->name('profile.upload');
        Route::post('/upload-galery-images', [UserProfileController::class, 'uploadGalleryImages'])->name('profile.storeImageGallery');
        Route::post('/galery-images-remove', [UserProfileController::class, 'removeGalleryImages'])->name('profile.removeImageGallery');


        Route::post('/profile/update/one', [UserProfileController::class, 'profileUpdateOne'])->name('profile.update.one');
        Route::post('/profile/update/description', [UserProfileController::class, 'UpdateDscription'])->name('profile.update.description');
        Route::post('/profile/update/personal-info', [UserProfileController::class, 'updatePersonalInfo'])->name('profile.update.personal.info');
        Route::get('/verify/account', [UserProfileController::class, 'verifyAccount'])->name('verify.account');
        Route::get('/profile/contact', [UserProfileController::class, 'ProfileContact'])->name('user.profile.contact');



        Route::get('/matches', [MatchesController::class, 'matches'])->name(name: 'user.matches');
        Route::get('/matches/profile/view', [MatchesController::class, 'profileView'])->name('matches.profile.view');
    });



    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

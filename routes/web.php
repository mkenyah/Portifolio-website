<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProjectsController;
use App\Http\Controllers\Admin\AdminCommentsController;
use App\Http\Controllers\Admin\AdminMessagesController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminLikesController;
use App\Http\Controllers\Admin\AdminRatingsController;
use App\Http\Controllers\Admin\AdminContactMessagesController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RatingController;

Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

// Project interactions
Route::post('/projects/{project}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/projects/{project}/likes', [LikeController::class, 'store'])->name('likes.store');
Route::post('/projects/{project}/ratings', [RatingController::class, 'store'])->name('ratings.store');

Route::get('/welcome', function () {
    $projects = \App\Models\Project::with(['ratings', 'likes'])->orderByRaw('github_time DESC')->paginate(9);

    // Calculate average rating and likes count for each project
    $projects->getCollection()->transform(function ($project) {
        $project->averageRating = $project->ratings->avg('rating') ?? 0;
        $project->likesCount = $project->likes->count();
        return $project;
    });

    // Fetch profile data
    $profile = \App\Models\Profile::first();

    return view('welcome', compact('projects', 'profile'));
});

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Hidden admin login route (discreet URL)
Route::get('/admin-login-unique-path', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login-unique-path', [AdminAuthController::class, 'login'])->name('admin.login.post');

// Default login route for web guard (redirects to admin login)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin routes group with auth middleware
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', AdminProjectsController::class);
    Route::resource('comments', AdminCommentsController::class)->only(['index', 'update', 'destroy']);
    Route::resource('likes', AdminLikesController::class)->only(['index', 'destroy']);
    Route::resource('ratings', AdminRatingsController::class)->only(['index', 'destroy']);
    Route::resource('contact-messages', AdminContactMessagesController::class)->only(['index', 'show', 'destroy']);
    Route::resource('messages', AdminMessagesController::class)->only(['index', 'show', 'destroy']);
    Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

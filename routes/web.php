<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Redirect authenticated users to /my-tasks, show welcome page for guests
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('my_tasks');
    }
    return view('welcome');
})->name('home'); // Added name for the route

// Custom authentication routes using AuthController
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');

// Routes accessible only to authenticated users
Route::middleware('auth')->group(function () {
    // Task Management Routes
    Route::get('/my-tasks', [TaskController::class, 'index'])->name('my_tasks');
    Route::get('/new-task', [TaskController::class, 'create'])->name('new_task');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
    Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
    Route::post('/tasks/{task}/notes', [TaskController::class, 'storeNote'])->name('task_notes.store');
    Route::post('/tasks/{task}/share', [TaskController::class, 'share'])->name('tasks.share');

    // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Test Email Route (secure it or remove in production)
    Route::get('/test-email', function () {
        $user = \App\Models\User::first();
        $task = \App\Models\Task::first();
        if ($user && $task) {
            $user->notify(new \App\Notifications\TaskReminder($task));
            return 'Email sent!';
        }
        return 'No user or task found.';
    })->middleware('throttle:1,1');
});
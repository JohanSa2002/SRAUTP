<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $publishedArticles = \App\Models\Article::with('student', 'advisor')
        ->where('status', 'aprobado')
        ->latest()
        ->take(6)
        ->get();
        
    $notices = \App\Models\Notice::where('is_active', true)
        ->latest()
        ->take(3)
        ->get();

    $events = \App\Models\Event::where('is_active', true)
        ->latest()
        ->take(3)
        ->get();

    return view('welcome', compact('publishedArticles', 'notices', 'events'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('articles', \App\Http\Controllers\ArticleController::class);
    Route::patch('articles/{article}/evaluate', [\App\Http\Controllers\ArticleController::class, 'evaluate'])->name('articles.evaluate');

    // Library (Librería)
    Route::get('/library', [\App\Http\Controllers\LibraryController::class, 'index'])->name('library.index');
    Route::post('/library', [\App\Http\Controllers\LibraryController::class, 'store'])->name('library.store');
    Route::delete('/library/{resource}', [\App\Http\Controllers\LibraryController::class, 'destroy'])->name('library.destroy');

    // Certificates (Certificados)
    Route::get('/certificates', [\App\Http\Controllers\CertificateController::class, 'index'])->name('certificates.index');
    Route::post('/certificates', [\App\Http\Controllers\CertificateController::class, 'store'])->name('certificates.store');
    Route::delete('/certificates/{certificate}', [\App\Http\Controllers\CertificateController::class, 'destroy'])->name('certificates.destroy');

    // Public Profiles
    Route::post('/profile/search', [\App\Http\Controllers\PublicProfileController::class, 'search'])->name('profile.search');
    Route::get('/profile/view/{id}', [\App\Http\Controllers\PublicProfileController::class, 'show'])->name('profile.public.show');
    
    // Events (Eventos)
    Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [\App\Http\Controllers\EventController::class, 'show'])->name('events.show');

    // Advisor Assistant Management (only full advisors, not assistants)
    Route::get('/advisor/assistants', [\App\Http\Controllers\AdvisorAssistantController::class, 'index'])->name('advisor.assistants.index');
    Route::post('/advisor/assistants/new', [\App\Http\Controllers\AdvisorAssistantController::class, 'storeNew'])->name('advisor.assistants.store-new');
    Route::post('/advisor/assistants', [\App\Http\Controllers\AdvisorAssistantController::class, 'store'])->name('advisor.assistants.store');
    Route::delete('/advisor/assistants/{user}', [\App\Http\Controllers\AdvisorAssistantController::class, 'destroy'])->name('advisor.assistants.destroy');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
        Route::delete('/users/{user}', [\App\Http\Controllers\AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/articles', [\App\Http\Controllers\AdminController::class, 'articles'])->name('articles');
        Route::resource('/notices', \App\Http\Controllers\NoticeController::class)->except(['show']);
        Route::resource('/events', \App\Http\Controllers\EventController::class)->except(['index', 'show']);
    });
});

require __DIR__ . '/auth.php';

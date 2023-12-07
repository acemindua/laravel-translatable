<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    $path = Route::getCurrentRoute()->getPath();
    return redirect($path);
})->name('swicher');
*/


Route::get('language/{locale}', [LanguageController::class, 'change'])->name('swicher');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/', function () {
            return Inertia::render('Home', [
                'posts' => Post::whereHas('translations', function ($query) {
                    $query->where('locale', app()->getLocale());
                })->latest()->get(),
                'locales'   => LaravelLocalization::getSupportedLocales(),
                //'canLogin' => Route::has('login'),
                //'canRegister' => Route::has('register'),
                //'laravelVersion' => Application::VERSION,
                //'phpVersion' => PHP_VERSION,
            ]);
        });
    }
);



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/dashboard/pages', PageController::class)->middleware(['auth', 'verified']);
Route::resource('/dashboard/posts', PostController::class)->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

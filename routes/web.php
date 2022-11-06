<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LocationController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('pages.admin.index');
// })->name('dashboard');

Route::get('/login', function () {
    return view('pages.auth.login');
});

Route::get('/', function () {
    $articles = Article::latest()->paginate(10)->withQueryString();
    $data = [
        'articles'  => $articles,
    ];
    return view('pages.admin.articles.index', $data);
});

Route::resource('/articles', ArticleController::class);
Route::resource('/events', EventController::class);
Route::resource('/locations', LocationController::class);

<?php

// use App\Models\Post;
// use App\Models\User;

use App\Http\Controllers\AccountSettings;
use App\Models\Category;
use App\Models\User;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserSettingsController;

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

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => "home"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => "about",
        "name" => "Aldi Ramdani",
        "email" => "ramdani@gmail.com",
        "image" => "aldi.png"
    ]);
});


Route::get('/posts', [PostController::class, 'index']);

// halaman single post
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// halaman categories
Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

// Route::get('/categories/{category:slug}', function(Category $category){
//     return view('posts', [
//         'title' => "Post By Category : $category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('category', 'author')
//     ]);
// });

// Route::get('/authors/{author:username}', function (User $author){
//     return view('posts', [
//         'title' => "Post By Author : $author->name ",
//         "active" => 'posts',
//         'posts' => $author->posts->load('category', 'author')
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
            return view('dashboard.index',  [
                'user' => User::where('id', auth()->user()->id)->first()
            ]);
})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

Route::resource('/dashboard/post-settings', SettingsController::class)->except('show')->middleware('admin');

Route::get('/dashboard/post-settings/{user}/detail', [SettingsController::class, 'detail'])->name('post-settings.detail');

Route::get('/dashboard/post-settings/post/{post}', [SettingsController::class, 'show']);

Route::get('/dashboard/post-settings/edit/{post}', [SettingsController::class, 'edit']);

Route::put('/dashboard/post-settings/update', [SettingsController::class, 'update']);

Route::delete('/dashboard/post-settings/{post}', 'SettingsController@destroy')->name('settings.destroy');

Route::resource('/dashboard/account-settings', AccountSettings::class)->middleware('auth');

Route::put('/dashboard/account-settings/update', [SettingsController::class, 'update'])->middleware('auth');


Route::resource('/dashboard/user-settings', UserSettingsController::class)->middleware('auth');

Route::get('/dashboard/user-settings/show/{user}', [UserSettingsController::class, 'show'])->name('user-settings.show');

Route::put('/dashboard/user-settings/update', [UserSettingsController::class, 'update'])->name('user-settings.update');

Route::get('/dashboard/user-settings/show/{user}/change', [UserSettingsController::class, 'change']);
<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Inertia\Inertia;

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
    return Inertia::render('Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'posts'=>$posts = \App\Models\Post::select('posts.id as id', 'posts.title as title', 'categories.title as category', 'posts.created_at as created_at')->join('categories', 'categories.id', '=', 'posts.category_id')->paginate(2),
        'categories' => \App\Models\Category::select('id','title')->get(),
    ]);
});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

//Route::resource('/posts',PostController::class);
Route::get('/posts' ,[PostController::class,'index'])->name('posts.index');
Route::get('/posts/create' ,[PostController::class,'create']);
Route::post('/posts' ,[PostController::class,'store']);
<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeSpecialPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('logout', function () {

    Auth::guard('admin')->logout();

    return redirect('/');

})->name('logout');

Route::get('login',[AdminController::class, 'login'])->name('login');
Route::post('admin-login',[AdminController::class, 'admin_login'])->name('admin_login');

Route::group(['middleware'=>'admin.auth'], function(){
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Category Routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/edit/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Tags Routes
    Route::get('/tag', [TagsController::class, 'index'])->name('tag.index');
    Route::get('/tag/create', [TagsController::class, 'create'])->name('tag.create');
    Route::post('/tag/create', [TagsController::class, 'store'])->name('tag.store');
    Route::get('/tag/edit/{tag}', [TagsController::class, 'edit'])->name('tag.edit');
    Route::post('/tag/edit/{tag}', [TagsController::class, 'update'])->name('tag.update');
    Route::delete('/tag/delete', [TagsController::class, 'destroy'])->name('tag.destroy');

    // Special Post
    Route::get('/special', [HomeSpecialPostController::class, 'index'])->name('special.index');
    Route::get('/special/create', [HomeSpecialPostController::class, 'create'])->name('special.create');
    Route::post('/special/fetch-category', [HomeSpecialPostController::class, 'fetch_category_post'])->name('special.fetch_category');
    Route::post('/special/create', [HomeSpecialPostController::class, 'store'])->name('special.store');
    Route::get('/special/edit/{special}', [HomeSpecialPostController::class, 'edit'])->name('special.edit');
    Route::post('/special/edit/{special}', [HomeSpecialPostController::class, 'update'])->name('special.update');
    Route::delete('/special/delete', [HomeSpecialPostController::class, 'destroy'])->name('special.destroy');

    // About Routes
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about/save', [AboutController::class, 'save'])->name('about.save');
    

    // Create Post
    Route::get('/createnewpost', [CreatePostController::class, 'index'])->name('post.new.index');
    Route::post('/createnewpost', [CreatePostController::class, 'create'])->name('post.new.create');
    Route::get('/editnewpost/{post}', [CreatePostController::class, 'editnew'])->name('post.new.editnew');
    Route::post('/storenewpost/{post}', [CreatePostController::class, 'savenewpost'])->name('post.new.savenew');

    Route::get('/{category}', [PostController::class, 'index'])->name('post.category.index');
    Route::get('/{category}/{post}', [PostController::class, 'editpost'])->name('post.editpost');
    Route::post('/{category}/{post}', [PostController::class, 'savepost'])->name('post.savepost');
    Route::delete('/post/delete', [PostController::class, 'deletepost'])->name('post.deletepost');

    


});


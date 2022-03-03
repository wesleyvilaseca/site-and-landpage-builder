<?php

use App\Http\Controllers\Admin\PainelController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionRoleController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/painel', [PainelController::class, 'index'])->name('painel');

    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts/new', [PostController::class, 'create'])->name('post.new');
    Route::post('/posts/save', [PostController::class, 'store'])->name('post.save');

    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/posts/{id}/update', [PostController::class, 'update'])->name('post.update');

    Route::get('/posts/{id}/remove', [PostController::class, 'delete'])->name('post.remove');

    /**
     * roles
     */

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/role/new', [RoleController::class, 'create'])->name('role.new');
    Route::post('/role/save', [RoleController::class, 'store'])->name('role.save');

    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('role.update');
    Route::get('/roles/{id}/remove', [RoleController::class, 'delete'])->name('role.remove');


    /**
     * permissions
     */
    Route::get('/role/{id}/permissions',    [PermissionRoleController::class, 'index'])->name('role.permissions');
    Route::post('/permissions/{id}/sync',   [PermissionRoleController::class, 'sync'])->name('role.permissions.sync');

    /**
     * permissions
     */

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/permission/new', [PermissionController::class, 'create'])->name('permission.new');
    Route::post('/permission/save', [PermissionController::class, 'store'])->name('permission.save');

    Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permission/{id}/update', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('/permission/{id}/remove', [PermissionController::class, 'delete'])->name('permission.remove');

    /**
     * user
     */

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/new', [UserController::class, 'create'])->name('user.new');
    Route::post('/user/save', [UserController::class, 'store'])->name('user.save');

    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}/remove', [UserController::class, 'delete'])->name('user.remove');
});


Route::get('/register',     [RegisterController::class, 'index'])->name('register');
Route::post('/register',    [RegisterController::class, 'create'])->name('register.create');

Route::get('/', function () {
    return view('welcome');
});

<?php

use App\Http\Controllers\Admin\AnotationController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Admin\PageBuilderController;
use App\Http\Controllers\Admin\PainelController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionRoleController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\QrcodeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebSiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WebsiteController as ControllersWebsiteController;
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
// Route::get('/',  [LoginController::class, 'index'])->name('inicio');

Route::middleware(['auth'])->group(function () {
    Route::get('/painel', [PainelController::class, 'index'])->name('painel');

    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts/new', [PostController::class, 'create'])->name('post.new');
    Route::post('/posts/save', [PostController::class, 'store'])->name('post.save');

    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/posts/{id}/update', [PostController::class, 'update'])->name('post.update');

    Route::get('/posts/{id}/remove', [PostController::class, 'delete'])->name('post.remove');

    /**
     * anotations
     */

    Route::get('/anotation', [AnotationController::class, 'index'])->name('anotation');
    Route::get('/anotation/new', [AnotationController::class, 'create'])->name('anotation.new');
    Route::post('/anotation/save', [AnotationController::class, 'store'])->name('anotation.save');

    Route::get('/anotation/{id}/edit', [AnotationController::class, 'edit'])->name('anotation.edit');
    Route::post('/anotation/{id}/update', [AnotationController::class, 'update'])->name('anotation.update');

    Route::get('/anotation/{id}/remove', [AnotationController::class, 'delete'])->name('anotation.remove');

    /**
     * QRCODE
     */

    Route::get('/qrcode', [QrcodeController::class, 'index'])->name('qrcode');
    Route::get('/qrcode/new', [QrcodeController::class, 'create'])->name('qrcode.new');
    Route::post('/qrcode/save', [QrcodeController::class, 'store'])->name('qrcode.save');

    Route::get('/qrcode/{id}/edit', [QrcodeController::class, 'edit'])->name('qrcode.edit');
    Route::post('/qrcode/{id}/update', [QrcodeController::class, 'update'])->name('qrcode.update');

    Route::get('/qrcode/{id}/remove', [QrcodeController::class, 'delete'])->name('qrcode.remove');

    /**
     * customers_type
     */

    Route::get('/customers-types', [CustomerTypeController::class, 'index'])->name('customers_types');
    Route::get('/customers-type/new', [CustomerTypeController::class, 'create'])->name('customers_type.new');
    Route::post('/customers-type/save', [CustomerTypeController::class, 'store'])->name('customers_type.save');

    Route::get('/customers-type/{id}/edit', [CustomerTypeController::class, 'edit'])->name('customers_type.edit');
    Route::post('/customers-type/{id}/update', [CustomerTypeController::class, 'update'])->name('customers_type.update');

    Route::get('/customers-type/{id}/remove', [CustomerTypeController::class, 'delete'])->name('customers_type.remove');

    /**
     * customers
     */

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/customers/new', [CustomerController::class, 'create'])->name('customers.new');
    Route::post('/customers/save', [CustomerController::class, 'store'])->name('customers.save');

    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/customers/{id}/update', [CustomerController::class, 'update'])->name('customers.update');

    Route::get('/customers/{id}/remove', [CustomerController::class, 'delete'])->name('customers.remove');

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

    /**
     * websites
     */
    Route::get('/website',              [WebSiteController::class, 'index'])->name('websites');
    Route::get('/website/create',       [WebSiteController::class, 'create'])->name('websites.create');
    Route::post('/website/create',      [WebSiteController::class, 'store'])->name('websites.store');
    Route::get('/website/{id}/edit',    [WebSiteController::class, 'edit'])->name('websites.edit');
    Route::post('/website/{id}/edit',   [WebSiteController::class, 'update'])->name('websites.update');
    Route::get('/website/{id}/delete', [WebSiteController::class, 'delete'])->name('websites.delete');

    Route::get('/website/{siteId}',     [WebSiteController::class, 'pages'])->name('pages');

    /**
     * page builder
     */
    Route::any('/pages/{id}/build', [PageBuilderController::class, 'build'])->name('pagebuilder.build');
    Route::any('/pages/build', [PageBuilderController::class, 'build']);
    Route::any('/admin/pages', [PageBuilderController::class, 'index']);
});


Route::get('/register',     [RegisterController::class, 'index'])->name('register');
Route::post('/register',    [RegisterController::class, 'create'])->name('register.create');

// Route::any('{uri}', [
//     'uses' => 'App\Http\Controllers\WebsiteController@uri',
//     'as' => 'page',
// ])->where('uri', '.*');

Route::any('/busca', [SearchController::class, 'search']);

Route::any('/', [ControllersWebsiteController::class, 'uri']);
Route::any('/{uri}', [ControllersWebsiteController::class, 'uri']);

// Route::get('/', function () {
//     return view('welcome');
// });

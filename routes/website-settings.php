<?php

use App\Http\Controllers\SiteSettings\DashboardController;
use App\Http\Controllers\SiteSettings\MenuController;
use App\Http\Controllers\SiteSettings\PageBuilderController;
use App\Http\Controllers\SiteSettings\PagesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'settings'])->group(function () {
    Route::group(['prefix' => 'settings'], function () {
        Route::post('/dashboard',            [DashboardController::class, 'index'])->name('websites.settings');

        /**
         * menus
         */
        Route::get('/menu',            [MenuController::class, 'index'])->name('menus');

        /**
         * pages admin
         */
        Route::get('/website/{siteId}',            [PagesController::class, 'index'])->name('pages');
        Route::get('/website/{siteId}/create',     [PagesController::class, 'create'])->name('pages.create');
        Route::post('/website/{siteId}/create',     [PagesController::class, 'store'])->name('pages.store');
        Route::get('/website/{siteId}/edit/{id}',     [PagesController::class, 'edit'])->name('pages.edit');
        Route::post('/website/{siteId}/edit/{id}',     [PagesController::class, 'update'])->name('pages.update');
        Route::get('/website/{siteId}/delete/{id}',     [PagesController::class, 'delete'])->name('pages.delete');

        /**
         * page builder
         */
        Route::any('/pages/{id}/build', [PageBuilderController::class, 'build'])->name('pagebuilder.build');
        Route::any('/pages/build', [PageBuilderController::class, 'build']);
        Route::any('/admin/pages', [PageBuilderController::class, 'index']);
    });
});

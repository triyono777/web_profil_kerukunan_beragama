<?php

use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\RouteInfoController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicAgendaController;
use App\Http\Controllers\PublicDocumentController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\PublicProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [PublicPageController::class, 'profile'])->name('profile.page');
Route::get('/pages/{slug}', [PublicPageController::class, 'show'])->name('pages.show');
Route::get('/program', [PublicProgramController::class, 'index'])->name('program.index');
Route::get('/berita', [PublicPostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PublicPostController::class, 'show'])->name('posts.show');
Route::get('/agenda', [PublicAgendaController::class, 'index'])->name('agenda.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/dokumen', [PublicDocumentController::class, 'index'])->name('documents.index');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('posts', AdminPostController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
        Route::resource('menus', MenuController::class);
        Route::resource('sections', SectionController::class);
        Route::resource('pages', AdminPageController::class);
        Route::resource('organization', OrganizationController::class);
        Route::resource('programs', AdminProgramController::class);
        Route::resource('agendas', AdminAgendaController::class);
        Route::resource('media', AdminMediaController::class);
        Route::resource('documents', AdminDocumentController::class);
        Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'destroy', 'update']);

        Route::get('footer', [FooterController::class, 'edit'])->name('footer.edit');
        Route::put('footer', [FooterController::class, 'update'])->name('footer.update');
        Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');
        Route::get('routes', [RouteInfoController::class, 'index'])->name('routes.index');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

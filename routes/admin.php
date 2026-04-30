<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
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

define('PAGINATION_COUNT', 11);
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {





    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'as' => 'admin.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');


        /*         start  update login admin                 */
        Route::get('/admin/edit/{id}', [LoginController::class, 'editlogin'])->name('login.edit');
        Route::post('/admin/update/{id}', [LoginController::class, 'updatelogin'])->name('login.update');
        /*         end  update login admin                */



        // Route for ajax



        // Hero Section (single record — edit/update only)
        Route::get('hero',        [HeroController::class, 'edit'])->name('hero.edit');
        Route::put('hero',        [HeroController::class, 'update'])->name('hero.update');

        // Services
        Route::resource('services',     ServiceController::class);
        Route::post('services/reorder', [ServiceController::class, 'reorder'])
            ->name('services.reorder');

        // Portfolio
        Route::resource('portfolio',    PortfolioController::class);

        // Clients
        Route::resource('clients',      ClientController::class);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);

        // Branches
        Route::resource('branches',     BranchController::class);

        // Settings
        Route::get('settings',         [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings',         [SettingController::class, 'update'])->name('settings.update');
    });
});



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});

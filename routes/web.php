<?php

use App\Http\Controllers\FrontCategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\FrontBlogController;
use App\Http\Controllers\FrontProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontAboutController;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichf
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {



  Route::get('/', [HomeController::class, 'index'])->name('home');

  // Optional detail pages
  Route::get('/services',     [HomeController::class, 'services'])->name('services');
  Route::get('/portfolio',    [HomeController::class, 'portfolio'])->name('portfolio');
  Route::get('/contact',      [HomeController::class, 'contact'])->name('contact');
  Route::post('/contact',     [HomeController::class, 'sendContact'])->name('contact.send');

  // Blog
  Route::get('/blog',         [FrontBlogController::class, 'index'])->name('blog.index');
  Route::get('/blog/{slug}',  [FrontBlogController::class, 'show'])->name('blog.show');

  // Careers
  Route::post('/careers/apply', [CareerController::class, 'apply'])->name('careers.apply');
});

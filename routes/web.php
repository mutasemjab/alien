<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\FrontBlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ToolsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ── Sitemap & robots (outside locale group — no locale prefix) ─────────
Route::get('/sitemap.xml',           [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-pages.xml',     [SitemapController::class, 'pages'])->name('sitemap.pages');
Route::get('/sitemap-blog.xml',      [SitemapController::class, 'blog'])->name('sitemap.blog');
Route::get('/sitemap-services.xml',  [SitemapController::class, 'services'])->name('sitemap.services');
Route::get('/sitemap-locations.xml', [SitemapController::class, 'locations'])->name('sitemap.locations');

// ── Localised front-end routes ─────────────────────────────────────────
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    // Core pages
    Route::get('/',          [HomeController::class, 'index'])->name('home');
    Route::get('/services',  [HomeController::class, 'services'])->name('services');
    Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
    Route::get('/contact',   [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact',  [HomeController::class, 'sendContact'])->name('contact.send');

    // Service detail pages
    Route::get('/services/{slug}', [HomeController::class, 'serviceDetail'])->name('services.show');

    // Blog (articles + landing pages share the same URL pattern; controller dispatches template)
    Route::get('/blog',        [FrontBlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [FrontBlogController::class, 'show'])->name('blog.show');

    // Careers
    Route::post('/careers/apply', [CareerController::class, 'apply'])->name('careers.apply');

    // Free tools / calculators
    Route::get('/tools',                        [ToolsController::class, 'index'])->name('tools.index');
    Route::get('/tools/salary-calculator',      [ToolsController::class, 'salary'])->name('tools.salary');
    Route::get('/tools/income-tax-calculator',  [ToolsController::class, 'incomeTax'])->name('tools.income-tax');
    Route::get('/tools/end-of-service',         [ToolsController::class, 'endOfService'])->name('tools.end-of-service');
    Route::get('/tools/vat-calculator',         [ToolsController::class, 'vat'])->name('tools.vat');
    Route::get('/tools/project-cost-estimator', [ToolsController::class, 'projectEstimator'])->name('tools.project-estimator');

    // Jordan city landing pages
    Route::get('/jordan/{city}', [LocationController::class, 'show'])->name('locations.show');
});

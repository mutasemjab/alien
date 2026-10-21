<?php

namespace App\Http\Controllers;

use App\Models\{Blog, Service, PortfolioItem, Setting};
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    private function siteUrl(): string
    {
        return rtrim(Setting::getValue('canonical_url', config('app.url')), '/');
    }

    public function index()
    {
        $siteUrl  = $this->siteUrl();
        $sitemaps = [
            ['loc' => $siteUrl . '/sitemap-pages.xml',    'lastmod' => now()->toAtomString()],
            ['loc' => $siteUrl . '/sitemap-blog.xml',     'lastmod' => now()->toAtomString()],
            ['loc' => $siteUrl . '/sitemap-services.xml', 'lastmod' => now()->toAtomString()],
        ];

        return response()
            ->view('sitemap.index', compact('sitemaps'))
            ->header('Content-Type', 'application/xml');
    }

    public function pages()
    {
        $siteUrl = $this->siteUrl();
        $urls    = [];

        // Homepages for each locale
        foreach (['en', 'ar'] as $locale) {
            $urls[] = [
                'loc'     => $siteUrl . '/' . $locale,
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority'   => '1.0',
            ];
        }

        // Services list pages
        foreach (['en', 'ar'] as $locale) {
            $urls[] = [
                'loc'        => $siteUrl . '/' . $locale . '/services',
                'lastmod'    => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority'   => '0.9',
            ];
        }

        // Service detail pages (only those with slugs)
        $services = Service::active()->hasDetail()->get();
        foreach ($services as $service) {
            foreach (['en', 'ar'] as $locale) {
                $urls[] = [
                    'loc'        => $siteUrl . '/' . $locale . '/services/' . $service->slug,
                    'lastmod'    => $service->updated_at?->toAtomString() ?? now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority'   => '0.8',
                ];
            }
        }

        // Blog list pages
        foreach (['en', 'ar'] as $locale) {
            $urls[] = [
                'loc'        => $siteUrl . '/' . $locale . '/blog',
                'lastmod'    => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority'   => '0.7',
            ];
        }

        // Contact pages
        foreach (['en', 'ar'] as $locale) {
            $urls[] = [
                'loc'        => $siteUrl . '/' . $locale . '/contact',
                'lastmod'    => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority'   => '0.6',
            ];
        }

        // Portfolio page
        foreach (['en', 'ar'] as $locale) {
            $urls[] = [
                'loc'        => $siteUrl . '/' . $locale . '/portfolio',
                'lastmod'    => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority'   => '0.6',
            ];
        }

        // Free tools hub and individual calculators
        $toolSlugs = [
            'tools',
            'tools/salary-calculator',
            'tools/income-tax-calculator',
            'tools/end-of-service',
            'tools/vat-calculator',
            'tools/project-cost-estimator',
        ];
        foreach ($toolSlugs as $slug) {
            foreach (['en', 'ar'] as $locale) {
                $urls[] = [
                    'loc'        => $siteUrl . '/' . $locale . '/' . $slug,
                    'lastmod'    => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority'   => '0.7',
                ];
            }
        }

        return response()
            ->view('sitemap.url-set', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }

    public function blog()
    {
        $siteUrl = $this->siteUrl();
        $urls    = [];

        $posts = Blog::active()->published()->orderByDesc('published_at')->get();

        foreach ($posts as $post) {
            foreach (['en', 'ar'] as $locale) {
                $priority = $post->type === 'landing_page' ? '0.8' : '0.7';
                $urls[] = [
                    'loc'        => $siteUrl . '/' . $locale . '/blog/' . $post->slug,
                    'lastmod'    => $post->updated_at?->toAtomString() ?? $post->published_at?->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority'   => $priority,
                    'image'      => $post->image ? asset('assets/admin/uploads/' . $post->image) : null,
                    'image_title'=> $post->title_en,
                ];
            }
        }

        return response()
            ->view('sitemap.url-set', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }

    public function services()
    {
        $siteUrl  = $this->siteUrl();
        $urls     = [];
        $services = Service::active()->hasDetail()->get();

        foreach ($services as $service) {
            foreach (['en', 'ar'] as $locale) {
                $urls[] = [
                    'loc'        => $siteUrl . '/' . $locale . '/services/' . $service->slug,
                    'lastmod'    => $service->updated_at?->toAtomString() ?? now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority'   => '0.8',
                ];
            }
        }

        return response()
            ->view('sitemap.url-set', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}

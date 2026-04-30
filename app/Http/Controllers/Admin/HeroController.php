<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::firstOrCreate(
            ['id' => 1],
            [
                'badge_text_en'       => 'Operational · All systems online',
                'badge_text_ar'       => 'تشغيلي · جميع الأنظمة تعمل',
                'title_line1_en'      => 'WE BUILD',
                'title_line1_ar'      => 'نحن نبني',
                'title_line2_en'      => 'DIGITAL WORLDS',
                'title_line2_ar'      => 'عوالم رقمية',
                'title_line3_en'      => 'FROM CODE',
                'title_line3_ar'      => 'من الكود',
                'description_en'      => 'Alien Code is a next-generation software development company.',
                'description_ar'      => 'ألين كود شركة تطوير برمجيات من الجيل القادم.',
                'btn_primary_text_en' => 'Explore Our Work',
                'btn_primary_text_ar' => 'استكشف أعمالنا',
                'btn_primary_url'     => '#work',
                'btn_secondary_text_en' => 'Start a Project',
                'btn_secondary_text_ar' => 'ابدأ مشروعك',
                'btn_secondary_url'   => '#contact',
                'stat_projects'       => 150,
                'stat_years'          => 8,
                'stat_engineers'      => 50,
                'stat_satisfaction'   => 98,
                'meta_title_en'       => 'Alien Code — Next-Gen Software Development Company',
                'meta_title_ar'       => 'ألين كود — شركة تطوير برمجيات الجيل القادم',
                'meta_description_en' => 'Alien Code builds high-performance web apps, mobile apps, AI systems and cloud infrastructure for startups and enterprises worldwide.',
                'meta_description_ar' => 'ألين كود تبني تطبيقات ويب وجوال وأنظمة ذكاء اصطناعي وبنية سحابية للشركات حول العالم.',
                'robots'              => 'index, follow',
                'twitter_card'        => 'summary_large_image',
                'schema_org_name'     => 'Alien Code',
                'schema_org_type'     => 'SoftwareCompany',
                'schema_org_founding_year' => '2016',
            ]
        );

        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            // ── Core ────────────────────────────────────────
            'badge_text_en'           => 'required|string|max:200',
            'badge_text_ar'           => 'required|string|max:200',
            'title_line1_en'          => 'required|string|max:100',
            'title_line1_ar'          => 'required|string|max:100',
            'title_line2_en'          => 'required|string|max:100',
            'title_line2_ar'          => 'required|string|max:100',
            'title_line3_en'          => 'required|string|max:100',
            'title_line3_ar'          => 'required|string|max:100',
            'description_en'          => 'required|string',
            'description_ar'          => 'required|string',
            'btn_primary_text_en'     => 'required|string|max:60',
            'btn_primary_text_ar'     => 'required|string|max:60',
            'btn_primary_url'         => 'required|string|max:200',
            'btn_secondary_text_en'   => 'required|string|max:60',
            'btn_secondary_text_ar'   => 'required|string|max:60',
            'btn_secondary_url'       => 'required|string|max:200',
            'stat_projects'           => 'required|integer|min:0',
            'stat_years'              => 'required|integer|min:0',
            'stat_engineers'          => 'required|integer|min:0',
            'stat_satisfaction'       => 'required|integer|min:0|max:100',

            // ── SEO Meta ─────────────────────────────────────
            'meta_title_en'           => 'required|string|max:70',
            'meta_title_ar'           => 'required|string|max:70',
            'meta_description_en'     => 'required|string|max:160',
            'meta_description_ar'     => 'required|string|max:160',
            'meta_keywords_en'        => 'nullable|string|max:500',
            'meta_keywords_ar'        => 'nullable|string|max:500',

            // ── Open Graph ────────────────────────────────────
            'og_title_en'             => 'nullable|string|max:200',
            'og_title_ar'             => 'nullable|string|max:200',
            'og_description_en'       => 'nullable|string|max:200',
            'og_description_ar'       => 'nullable|string|max:200',
            'og_image'                => 'nullable|image|max:2048|dimensions:min_width=600',

            // ── Twitter Card ──────────────────────────────────
            'twitter_card'            => 'nullable|in:summary,summary_large_image',
            'twitter_title_en'        => 'nullable|string|max:200',
            'twitter_title_ar'        => 'nullable|string|max:200',
            'twitter_description_en'  => 'nullable|string|max:200',
            'twitter_description_ar'  => 'nullable|string|max:200',

            // ── Schema.org ────────────────────────────────────
            'schema_org_name'                  => 'nullable|string|max:100',
            'schema_org_type'                  => 'nullable|string|max:60',
            'schema_org_url'                   => 'nullable|url|max:200',
            'schema_org_founding_year'         => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'schema_org_number_of_employees'   => 'nullable|integer|min:1',
            'schema_org_description_en'        => 'nullable|string|max:500',
            'schema_org_description_ar'        => 'nullable|string|max:500',

            // ── Canonical / Robots ────────────────────────────
            'canonical_url_en'        => 'nullable|url|max:200',
            'canonical_url_ar'        => 'nullable|url|max:200',
            'robots'                  => 'nullable|string|max:50',
        ]);

        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $hero = HeroSection::find(1);
            $data['og_image'] = uploadImage('assets/admin/uploads', $request->og_image);
        }

        HeroSection::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Hero section saved successfully.');
    }
}
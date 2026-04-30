<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
 
            // ── Badge ────────────────────────────────────────
            $table->string('badge_text_en');
            $table->string('badge_text_ar');
 
            // ── Title Lines ──────────────────────────────────
            $table->string('title_line1_en');
            $table->string('title_line1_ar');
            $table->string('title_line2_en');
            $table->string('title_line2_ar');
            $table->string('title_line3_en');
            $table->string('title_line3_ar');
 
            // ── Description ──────────────────────────────────
            $table->text('description_en');
            $table->text('description_ar');
 
            // ── CTA Buttons ──────────────────────────────────
            $table->string('btn_primary_text_en')->default('Explore Our Work');
            $table->string('btn_primary_text_ar')->default('استكشف أعمالنا');
            $table->string('btn_primary_url')->default('#work');
            $table->string('btn_secondary_text_en')->default('Start a Project');
            $table->string('btn_secondary_text_ar')->default('ابدأ مشروعك');
            $table->string('btn_secondary_url')->default('#contact');
 
            // ── Stats ────────────────────────────────────────
            $table->unsignedSmallInteger('stat_projects')->default(150);
            $table->unsignedSmallInteger('stat_years')->default(8);
            $table->unsignedSmallInteger('stat_engineers')->default(50);
            $table->unsignedSmallInteger('stat_satisfaction')->default(98);
 
            // ── SEO Meta ─────────────────────────────────────
            $table->string('meta_title_en', 70)->default('Alien Code — Next-Gen Software Development Company');
            $table->string('meta_title_ar', 70)->default('ألين كود — شركة تطوير برمجيات الجيل القادم');
            $table->text('meta_description_en')->default('Alien Code builds high-performance web apps, mobile apps, AI systems and cloud infrastructure for startups and enterprises worldwide.');
            $table->text('meta_description_ar')->default('ألين كود تبني تطبيقات ويب وجوال وأنظمة ذكاء اصطناعي وبنية سحابية للشركات الناشئة والمؤسسات حول العالم.');
            $table->string('meta_keywords_en')->nullable();
            $table->string('meta_keywords_ar')->nullable();
 
            // ── Open Graph / Social Share ─────────────────────
            $table->string('og_title_en')->nullable();
            $table->string('og_title_ar')->nullable();
            $table->string('og_description_en', 200)->nullable();
            $table->string('og_description_ar', 200)->nullable();
            $table->string('og_image')->nullable();          // storage path
 
            // ── Twitter Card ──────────────────────────────────
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_title_en')->nullable();
            $table->string('twitter_title_ar')->nullable();
            $table->string('twitter_description_en', 200)->nullable();
            $table->string('twitter_description_ar', 200)->nullable();
 
            // ── Schema.org Structured Data ────────────────────
            $table->string('schema_org_name')->default('Alien Code');
            $table->string('schema_org_type')->default('SoftwareCompany');
            $table->string('schema_org_url')->nullable();
            $table->string('schema_org_logo')->nullable();
            $table->string('schema_org_description_en')->nullable();
            $table->string('schema_org_description_ar')->nullable();
            $table->string('schema_org_founding_year')->default('2016');
            $table->string('schema_org_number_of_employees')->nullable();
 
            // ── Canonical / Robots ────────────────────────────
            $table->string('canonical_url_en')->nullable();
            $table->string('canonical_url_ar')->nullable();
            $table->string('robots')->default('index, follow');
 
            // ── Status ───────────────────────────────────────
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('');
        $this->command->info('╔══════════════════════════════════════════════════╗');
        $this->command->info('║        Alien Code — SEO Content Seeder           ║');
        $this->command->info('╚══════════════════════════════════════════════════╝');
        $this->command->info('');

        $this->command->info('Step 1/6 — Service SEO fields (slug, body, meta)');
        $this->call(SeoServicesSeeder::class);

        $this->command->info('');
        $this->command->info('Step 2/6 — SEO articles (type=article)');
        $this->call(SeoArticlesSeeder::class);

        $this->command->info('');
        $this->command->info('Step 3/6 — SEO landing pages (type=landing_page)');
        $this->call(SeoLandingPagesSeeder::class);

        $this->command->info('');
        $this->command->info('Step 4/6 — Industry vertical landing pages');
        $this->call(SeoIndustriesSeeder::class);

        $this->command->info('');
        $this->command->info('Step 5/6 — Technology stack landing pages');
        $this->call(SeoTechPagesSeeder::class);

        $this->command->info('');
        $this->command->info('Step 6/6 — Cost & guide landing pages');
        $this->call(SeoGuidesSeeder::class);

        $this->command->info('');
        $this->command->info('✓ All SEO content seeded successfully.');
        $this->command->info('');
        $this->command->line('Run the sitemap to verify: php artisan route:list | grep sitemap');
        $this->command->line('Then visit /sitemap.xml in your browser to confirm URLs.');
        $this->command->info('');
    }
}

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

        $this->command->info('Step 1/3 — Service SEO fields (slug, body, meta)');
        $this->call(SeoServicesSeeder::class);

        $this->command->info('');
        $this->command->info('Step 2/3 — SEO articles (type=article)');
        $this->call(SeoArticlesSeeder::class);

        $this->command->info('');
        $this->command->info('Step 3/3 — SEO landing pages (type=landing_page)');
        $this->call(SeoLandingPagesSeeder::class);

        $this->command->info('');
        $this->command->info('✓ All SEO content seeded successfully.');
        $this->command->info('');
        $this->command->line('Run the sitemap to verify: php artisan route:list | grep sitemap');
        $this->command->line('Then visit /sitemap.xml in your browser to confirm URLs.');
        $this->command->info('');
    }
}

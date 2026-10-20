<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug', 100)->nullable()->unique()->after('is_active');
            $table->longText('body_en')->nullable()->after('slug');
            $table->longText('body_ar')->nullable()->after('body_en');
            $table->string('meta_title_en', 200)->nullable()->after('body_ar');
            $table->string('meta_title_ar', 200)->nullable()->after('meta_title_en');
            $table->text('meta_desc_en')->nullable()->after('meta_title_ar');
            $table->text('meta_desc_ar')->nullable()->after('meta_desc_en');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'body_en', 'body_ar',
                'meta_title_en', 'meta_title_ar',
                'meta_desc_en', 'meta_desc_ar',
            ]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Clients / Logos
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('website_url')->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('author_name_en');
            $table->string('author_name_ar');
            $table->string('author_role_en');
            $table->string('author_role_ar');
            $table->string('author_company');
            $table->string('avatar')->nullable();
            $table->text('quote_en');
            $table->text('quote_ar');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Branches / Offices
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('city_en');
            $table->string('city_ar');
            $table->string('country_en');
            $table->string('country_ar');
            $table->string('flag_emoji')->default('🏢');
            $table->string('label_en')->nullable();  // "HQ", "Regional", etc.
            $table->string('label_ar')->nullable();
            $table->string('address_en');
            $table->string('address_ar');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('working_hours_en')->nullable();
            $table->string('working_hours_ar')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // Site Settings (key-value)
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general'); // general, seo, social, contact
            $table->string('type')->default('text');     // text, textarea, image, boolean
            $table->string('label_en');
            $table->string('label_ar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('clients');
    }
};

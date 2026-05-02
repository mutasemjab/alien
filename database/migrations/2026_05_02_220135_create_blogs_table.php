<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->text('excerpt_ar')->nullable();
            $table->longText('body_en')->nullable();
            $table->longText('body_ar')->nullable();
            $table->string('image')->nullable();
            $table->string('category_en', 100)->nullable();
            $table->string('category_ar', 100)->nullable();
            $table->json('tags')->nullable();
            $table->string('author', 100)->nullable();
            $table->string('meta_title_en', 200)->nullable();
            $table->string('meta_title_ar', 200)->nullable();
            $table->text('meta_desc_en')->nullable();
            $table->text('meta_desc_ar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->useCurrent();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};

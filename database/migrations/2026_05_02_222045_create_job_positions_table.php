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
        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->string('department_en', 100)->nullable();
            $table->string('department_ar', 100)->nullable();
            $table->string('location_en', 100)->nullable();
            $table->string('location_ar', 100)->nullable();
            $table->enum('type', ['full-time', 'part-time', 'remote', 'hybrid', 'internship', 'contract'])->default('full-time');
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('requirements_en')->nullable();
            $table->text('requirements_ar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_positions');
    }
};

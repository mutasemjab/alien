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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('label_en')->nullable()->change();
            $table->string('label_ar')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('label_en')->nullable(false)->change();
            $table->string('label_ar')->nullable(false)->change();
        });
    }
};

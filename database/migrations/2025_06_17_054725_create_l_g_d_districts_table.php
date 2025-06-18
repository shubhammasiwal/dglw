<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('l_g_d_districts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('state_code');
            $table->string('state_name');
            $table->integer('district_lgd_code')->unique();
            $table->string('district_name_en');
            $table->string('district_name_local')->nullable();
            $table->string('hierarchy')->nullable();
            $table->string('district_short_name', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_g_d_districts');
    }
};

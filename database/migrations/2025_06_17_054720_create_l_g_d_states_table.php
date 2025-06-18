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
        Schema::create('l_g_d_states', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('l_g_d_code')->unique();
            $table->string('name_en', 100);
            $table->string('name_local', 150)->nullable();
            $table->enum('type', ['state', 'union_territory'])->default('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_g_d_states');
    }
};

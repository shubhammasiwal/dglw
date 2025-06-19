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
        Schema::create('workers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('worker_type_id');
            $table->string('uan_number')->unique();
            $table->uuid('eshram_id')->unique();
            $table->string('aadhar_photo')->nullable();
            $table->string('aadhar_name')->nullable();
            $table->uuid('gender_id')->nullable();
            $table->datetime('aadhar_dob_yob')->nullable();
            $table->string('aadhar_address')->nullable();
            $table->string('hashed_aadhaar')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('alternate_mobile_number')->nullable();
            $table->string('father_name')->nullable();
            $table->string('husband_name')->nullable();
            $table->uuid('social_category_id')->nullable();
            $table->uuid('marital_status_id')->nullable();
            $table->boolean('is_migrated')->default(false);
            $table->boolean('is_disabled')->default(false);
            $table->boolean('is_deseased')->default(false);
            $table->datetime('date_of_death')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('worker_type_id')->references('id')->on('worker_types')->onDelete('cascade');
            $table->foreign('eshram_id')->references('id')->on('eshrams')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->foreign('social_category_id')->references('id')->on('social_categories')->onDelete('cascade');
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('slug')->unique()->nullable();

            $table->string('job_image')->nullable();
            
            $table->unsignedBigInteger('job_id')->nullable();
            
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->text('organisation_name')->nullable();
            $table->bigInteger('total_vacancies')->nullable();
            $table->text('application_mode')->nullable();
            $table->string('job_location')->nullable();

            $table->longText('important_dates')->nullable();
            $table->longText('application_fee_points')->nullable();


            $table->mediumText('age_header')->nullable();
            $table->longText('age_points')->nullable();            

            $table->longText('job_post_datails')->nullable();

            $table->longText('job_post_useful_links')->nullable();

            $table->longText('job_post_faq')->nullable();


            $table->string('author')->nullable();            
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

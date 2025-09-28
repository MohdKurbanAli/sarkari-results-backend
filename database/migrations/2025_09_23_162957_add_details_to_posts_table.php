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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('author');
            $table->mediumText('meta_description')->nullable()->after('meta_title');
            $table->mediumText('meta_keywords')->nullable()->after('meta_description');
            $table->longText('page_header_script')->nullable()->after('meta_keywords');
            $table->longText('page_footer_script')->nullable()->after('page_header_script');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords', 'page_header_script', 'page_footer_script']);
        });
    }
};

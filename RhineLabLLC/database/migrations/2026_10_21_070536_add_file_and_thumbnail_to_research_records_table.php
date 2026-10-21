<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('research_records', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('image_path');
            $table->string('thumbnail_path')->nullable()->after('file_path');
        });
    }

    public function down(): void
    {
        Schema::table('research_records', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'thumbnail_path']);
        });
    }
};
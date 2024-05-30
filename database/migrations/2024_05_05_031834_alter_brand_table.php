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
        Schema::table('brand', function (Blueprint $table) {
            $table->string("meta_title")->after("slug");
            $table->text("meta_description")->after("meta_title");
            $table->string("meta_keywords")->after("meta_description");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brand', function (Blueprint $table) {
            $table->dropColumn("meta_title");
            $table->dropColumn("meta_description");
            $table->dropColumn("meta_keywords");
        });
    }
};

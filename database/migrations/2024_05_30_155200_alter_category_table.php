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
        Schema::table('categories', function (Blueprint $table) {
            $table->string("image_name")->after("meta_keywords")->nullable();
            $table->string("button_name")->after("image_name")->nullable();
            $table->tinyInteger("is_home")->after("meta_keywords")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('image_name');
            $table->dropColumn('button_name');
            $table->dropColumn('is_home');
        });
    }
};

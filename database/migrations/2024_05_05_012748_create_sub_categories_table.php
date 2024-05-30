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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status')->default(0)->comment('0:active, 1:inactive');
            $table->tinyInteger('is_delete')->default(0)->comment('0:not, 1:deleted');
            $table->string("meta_title");
            $table->text("meta_description");
            $table->string("meta_keywords");
            $table->string("created_by");
            $table->foreignId("category_id")->constrained("categories")->onDelete("cascade");
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};

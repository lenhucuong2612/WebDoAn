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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            //$table->foreignId('catgory_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brand')->onDelete('cascade');
            $table->double('old_price');
            $table->double('price');
            $table->integer('quantity')->default(1);
            $table->string('short_description');
            $table->text('description');
            $table->text('additional_information');
            $table->text('shipping_returns');
            $table->tinyInteger('status')->default(0)->comment('0:active, 1:inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};

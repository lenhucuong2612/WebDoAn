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
        Schema::create('discount_code', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type");
            $table->float("percent_amount");
            $table->date("expire_date");
            $table->tinyInteger("status")->default(0)->comment('0:active, 1:inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_code');
    }
};

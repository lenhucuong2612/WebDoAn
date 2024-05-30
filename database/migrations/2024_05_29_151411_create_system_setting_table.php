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
        Schema::create('system_setting', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('fevicon')->nullable();
            $table->string('footer_description')->nullable();
            $table->string('footer_payment_icon')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('submit_email')->nullable();
            $table->string('email')->nullable();
            $table->string('email_two')->nullable();
            $table->string('working_hour')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtobe_link')->nullable();
            $table->string('pinterest_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_setting');
    }
};

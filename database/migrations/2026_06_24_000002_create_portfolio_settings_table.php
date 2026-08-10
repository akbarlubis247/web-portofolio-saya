<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Your Name');
            $table->string('title')->default('Data Analyst');
            $table->string('tagline')->nullable();
            $table->text('about_bio')->nullable();
            $table->text('career_goal')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->json('skills')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_settings');
    }
};

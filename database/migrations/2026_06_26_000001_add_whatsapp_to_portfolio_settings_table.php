<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('portfolio_settings', 'whatsapp')) {
            return;
        }

        Schema::table('portfolio_settings', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('portfolio_settings', 'whatsapp')) {
            return;
        }

        Schema::table('portfolio_settings', function (Blueprint $table) {
            $table->dropColumn('whatsapp');
        });
    }
};

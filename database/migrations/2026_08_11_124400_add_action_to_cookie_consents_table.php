<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cookie_consents', function (Blueprint $table) {
            $table->string('action')->default('updated')->after('consent_given');
            $table->index('action');
        });
    }

    public function down(): void
    {
        Schema::table('cookie_consents', function (Blueprint $table) {
            $table->dropIndex(['action']);
            $table->dropColumn('action');
        });
    }
};
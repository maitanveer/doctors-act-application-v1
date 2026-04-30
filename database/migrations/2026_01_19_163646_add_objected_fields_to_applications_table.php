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
        Schema::table('applications', function (Blueprint $table) {
            $table->text('objected_fields')->nullable()->after('requested_fields');
            $table->text('objection_message')->nullable()->after('objected_fields');
            $table->boolean('objection_pending')->default(false)->after('objection_message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['objected_fields', 'objection_message', 'objection_pending']);
        });
    }
};

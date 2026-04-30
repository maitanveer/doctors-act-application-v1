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
            $table->text('admin_notes')->nullable()->after('status');
            $table->text('rejection_reason')->nullable()->after('admin_notes');
            $table->boolean('document_request_pending')->default(false)->after('rejection_reason');
            $table->text('requested_fields')->nullable()->after('document_request_pending');
            $table->text('request_message')->nullable()->after('requested_fields');
            $table->timestamp('status_updated_at')->nullable()->after('request_message');
            $table->unsignedBigInteger('updated_by')->nullable()->after('status_updated_at');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropColumn([
                'admin_notes',
                'rejection_reason',
                'document_request_pending',
                'requested_fields',
                'request_message',
                'status_updated_at',
                'updated_by'
            ]);
        });
    }
};

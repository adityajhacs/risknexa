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
        Schema::table('assessments', function (Blueprint $table) {

            // Framework Relationship
            $table->foreignId('framework_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete()
                  ->after('vendor_id');

            // Assessment Description
            $table->text('description')
                  ->nullable()
                  ->after('assessment_name');

            // Created By
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->after('reviewer');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {

            $table->dropForeign(['framework_id']);
            $table->dropForeign(['created_by']);

            $table->dropColumn([
                'framework_id',
                'description',
                'created_by',
            ]);

        });
    }
};
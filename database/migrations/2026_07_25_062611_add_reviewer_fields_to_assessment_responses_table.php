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
    Schema::table('assessment_responses', function (Blueprint $table) {

        $table->string('review_decision')->nullable()->after('implementation_status');

        $table->integer('review_score')->nullable()->after('review_decision');

        $table->foreignId('reviewed_by')
              ->nullable()
              ->constrained('users')
              ->nullOnDelete();

        $table->timestamp('reviewed_at')->nullable();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessment_responses', function (Blueprint $table) {
            //
        });
    }
};

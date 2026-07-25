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

        $table->string('questionnaire')->nullable();

        $table->string('priority')
              ->default('Low');

        $table->string('assigned_by')
              ->nullable();

        $table->string('reviewer')
              ->nullable();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {

        $table->dropColumn([
            'questionnaire',
            'priority',
            'assigned_by',
            'reviewer'
        ]);

    });
    }
};
